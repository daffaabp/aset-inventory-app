<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Bidang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
        $bidangs = Bidang::all(); // Tambahkan ini$bidangs = Bidang::all(); // Tambahkan ini
        return view('user.create', compact('roles', 'bidangs'));
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        try {
            // Simpan data ke dalam tabel users
            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->password = bcrypt($validated['password']);
            $user->id_bidang = $validated['id_bidang'];
            $user->keterangan_bidang = $validated['keterangan_bidang'];

            // Upload dan simpan foto
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fileName = time() . '_' . $foto->getClientOriginalName();
                $path = $request->file('foto')->storeAs('user_fotos', $fileName, 'public');
                $user->foto = $path;
            }

            // Simpan ke dalam database
            $user->save();
            $user->assignRole($validated['roles']);

            // Ambil izin dari peran yang ditetapkan ke pengguna
            $permissionsFromRoles = $user->getPermissionsViaRoles();

            // Memberikan izin yang ada dalam peran secara langsung ke pengguna
            $user->givePermissionTo($permissionsFromRoles);

            return redirect()->route('user.index')
                ->with('success', 'User created successfully');
        } catch (\Exception $e) {
            // Handle exception here
            return redirect()->back()->with('error', 'Failed to create user.')->withInput();
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $bidangs = Bidang::all();
        // $roles = Role::pluck('name', 'name')->all();
        $roles = Role::where('name', '!=', 'Superadmin')->pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        // Jika pengguna yang sedang diedit adalah Superadmin, atur peran menjadi read-only
        $isSuperadmin = $user->hasRole('Superadmin');

        return view('user.edit', compact(['user', 'roles', 'userRole', 'isSuperadmin', 'bidangs']));
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
            'id_bidang' => 'required',
            'keterangan_bidang' => 'required',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
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
