<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $data = User::with('roles')->select('id', 'name', 'email')->get();
        return view('user.index', compact('data'));
    }

    public function create()
    {
        $roles = Role::all();
        // reject untuk menghapus peran dengan nama "Superadmin"
        $roles = $roles->reject(function ($role) {
            return $role->name === 'Superadmin';
        });
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        // Ambil izin dari peran yang ditetapkan ke pengguna
        $permissionsFromRoles = $user->getPermissionsViaRoles();

        // Memberikan izin yang ada dalam peran secara langsung ke pengguna
        $user->givePermissionTo($permissionsFromRoles);

        return redirect()->route('user.index')
            ->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        // $roles = Role::pluck('name', 'name')->all();
        $roles = Role::where('name', '!=', 'Superadmin')->pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        // Jika pengguna yang sedang diedit adalah Superadmin, atur peran menjadi read-only
        $isSuperadmin = $user->hasRole('Superadmin');

        return view('user.edit', compact(['user', 'roles', 'userRole', 'isSuperadmin']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        // Menghapus peran yang sebelumnya dimiliki oleh pengguna
        $user->roles()->detach();

        // Menambahkan peran baru yang dipilih dari form
        $user->assignRole($request->input('roles'));

        // Sinkronkan izin pengguna dengan izin dari peran baru yang diberikan
        $permissions = $user->getAllPermissions();
        $user->givePermissionTo($permissions);

        return redirect()->route('user.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->hasRole('Superadmin')) {
            // Jika user adalah superadmin
            // Lalu, periksa apakah user yang sedang dihapus adalah user yang sedang masuk ke dalam aplikasi
            if ($user->id === auth()->user()->id) {
                return redirect()->route('user.index')->with('error', 'Tidak dapat menghapus akun superadmin Anda sendiri');
            }
        }

        // Jika bukan superadmin atau bukan user yang sedang masuk, lanjutkan proses penghapusan
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }

}
