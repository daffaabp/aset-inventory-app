<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         // Mendapatkan permission dari user yang login
    //         $this->permission_login = auth()->user()->getAllPermissions()->pluck('name')->toArray();

    //         return $next($request);
    //     });
    // }

    // public function __construct()
    // {
    //     $permission_login = ['role.index', 'role.create', 'role.store', 'role.edit', 'role.update', 'role.destroy'];

    //     // cek apakah $permission_login memiliki akses ke fungsi yang ada pada halaman ini

    //     // bagaimana cara mendapatkan nama fungsi permission yang di akses di laravel

    //     $fungsi_yang_diakses = Url::current(); // 'user.destroy'
    //     if (!in_array($fungsi_yang_diakses, $permission_login)) {
    //         throw new Exception('Forbidden Access', 403);
    //     }
    // }

    // public function __construct()
    // {
    //     // Define permissions or roles relevant to this controller
    //     $permissions = ['role.index', 'role.create', 'role.store', 'role.edit', 'role.update', 'role.destroy'];

    //     // Get the currently authenticated user
    //     $user = Auth::user();

    //     // bagaimana cara mendapatkan nama fungsi permission yang di akses di laravel
    //     $currentRoute = Route::currentRouteName();

    //     // cek apakah $permission_login memiliki akses ke fungsi yang ada pada halaman ini
    //     if (!in_array($currentRoute, $permissions)) {
    //         throw new \Exception('Forbidden Access', 403);
    //     }

    //     if (!$user->hasPermissionTo($currentRoute)) {
    //         throw new \Exception('Forbidden Access', 403);
    //     }
    // }

    // public function __construct()
    // {
    //     $this->middleware('permission:role.index|role.create|role.edit|role.destroy', ['only' => ['index', 'show']]);
    //     $this->middleware('permission:role.create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:role.edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:role.destroy', ['only' => ['destroy']]);
    // }

    public function index()
    {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    public function create()
    {
        $permission = Permission::all();
        return view('role.create', compact('permission'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->name]);

        $permissions = Permission::whereIn('id', $request->input('permission'))->get();
        $role->syncPermissions($permissions);

        return redirect()->route('role.index')->with('success', 'Role baru berhasil dibuat!');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = $role->permissions()->pluck('id')->all();
        return view('role.edit', compact('role', 'permission', 'rolePermissions'));

    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        // Mendapatkan permission yang telah dipilih dari formulir edit
        $permissions = $request->input('permission', []);

        // Mendapatkan permission yang sudah dimiliki oleh role yang sedang diubah
        $existingPermissions = $role->permissions->pluck('id')->toArray();

        // Menemukan permission baru yang harus ditambahkan ke role
        $permissionsToAdd = array_diff($permissions, $existingPermissions);

        // Menemukan permission yang harus dihapus dari role
        $permissionsToRemove = array_diff($existingPermissions, $permissions);

        // Menambahkan permission baru ke role
        foreach ($permissionsToAdd as $permissionId) {
            $permission = Permission::find($permissionId);
            $role->givePermissionTo($permission);
        }

        // Menghapus permission yang tidak dipilih dari role
        foreach ($permissionsToRemove as $permissionId) {
            $permission = Permission::find($permissionId);
            $role->revokePermissionTo($permission);
        }

        // Update permission pada model_has_permissions untuk pengguna terkait
        foreach ($role->users as $user) {
            $userPermissions = $user->permissions->pluck('id')->toArray();

            // Menemukan permission baru yang harus ditambahkan ke pengguna
            $userPermissionsToAdd = array_diff($permissions, $userPermissions);

            // Menemukan permission yang harus dihapus dari pengguna
            $userPermissionsToRemove = array_diff($userPermissions, $permissions);

            // Menambahkan permission baru ke pengguna
            foreach ($userPermissionsToAdd as $permissionId) {
                $permission = Permission::find($permissionId);
                $user->givePermissionTo($permission);
            }

            // Menghapus permission yang tidak dipilih dari pengguna
            foreach ($userPermissionsToRemove as $permissionId) {
                $permission = Permission::find($permissionId);
                $user->revokePermissionTo($permission);
            }
        }

        return redirect()->route('role.index')->with('success', 'Role berhasil diupdate dengan permission yang baru.');

    }

    public function destroy(string $id)
    {
        $role = Role::find($id);

        // Mengambil informasi pengguna yang sedang login
        $user = Auth::user();

        // Periksa apakah rolenya adalah superadmin
        if ($role->name === 'Superadmin' && $user->hasRole('Superadmin')) {
            return redirect()->route('role.index')->with('error', 'Anda tidak bisa menghapus peran Superadmin sendiri.');
        }

        // Periksa apakah masih ada pengguna yang memiliki role ini
        $usersWithRole = $role->users;
        if ($usersWithRole->isNotEmpty()) {
            return redirect()->route('role.index')->with('error', 'Tidak dapat menghapus role yang masih digunakan oleh pengguna');
        }

        // Hapus peran jika bukan peran Superadmin atau pengguna yang login bukanlah Superadmin
        $role->delete();

        return redirect()->route('role.index')->with('success', 'Role deleted successfully');
    }

    public function getRoutesAllJson()
    {
        $routes = Route::getRoutes();

        $routename = [];
        foreach ($routes as $r) {
            $routename[] = $r->getName();
        }

        $existingRoutes = DB::table('permissions')->whereIn('name', $routename)->pluck('name')->toArray();

        $dataToInsert = [];

        foreach ($routes as $route) {
            $routeName = $route->getName();
            if ($routeName !== null && !Str::startsWith($routeName, ['password.', 'verification.', 'debugbar.', 'sanctum.', 'ignition.', 'profile.', 'login', 'logout', 'register', 'dashboard'])) {
                if (!in_array($routeName, $existingRoutes)) {
                    if ($route->getName() != null) {
                        $dataToInsert[] = [
                            'name' => $route->getName(),
                            'guard_name' => 'web',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            }
        }

        if (!empty($dataToInsert)) {
            DB::table('permissions')->insert($dataToInsert);
            return redirect()->back()->with('success', 'Routes Berhasil Di Update!');
        } else {
            return redirect()->back()->with('success', 'Semua Routes Sudah Berhasil Ditambahkan!');
        }
    }

    public function getRefreshAndDeleteJson()
    {
        // Ambil semua routes dari proyek
        $routes = Route::getRoutes();
        $routeNames = collect($routes)->map(function ($route) {
            return $route->getName();
        })->filter(function ($name) {
            // Filter out routes that should not be considered for deletion
            return $name !== null && !Str::startsWith($name, [
                'password.',
                'verification.',
                'debugbar.',
                'sanctum.',
                'ignition.',
                'profile.',
                'login',
                'logout',
                'register',
                'dashboard',
            ]);
        })->toArray();

        // Ambil semua nama permissions dari tabel permissions
        $permissions = DB::table('permissions')->pluck('name')->toArray();

        // Temukan nama permissions yang perlu dihapus
        $permissionsToDelete = array_diff($permissions, $routeNames);

        // Hapus permissions yang tidak cocok dengan routes
        if (!empty($permissionsToDelete)) {
            DB::table('permissions')->whereIn('name', $permissionsToDelete)->delete();
            return redirect()->back()->with('success', 'Permissions yang tidak terpakai berhasil dihapus.');
        } else {
            return redirect()->back()->with('success', 'Tidak ada permissions yang dihapus.');
        }
    }

}
