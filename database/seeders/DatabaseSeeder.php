<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {

        Permission::create(['name' => 'user.index']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.store']);
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'user.update']);
        Permission::create(['name' => 'user.destroy']);

        Permission::create(['name' => 'role.index']);
        Permission::create(['name' => 'role.create']);
        Permission::create(['name' => 'role.store']);
        Permission::create(['name' => 'role.edit']);
        Permission::create(['name' => 'role.update']);
        Permission::create(['name' => 'role.destroy']);
        Permission::create(['name' => 'role.getRoutesAllJson']);
        Permission::create(['name' => 'role.getRefreshAndDeleteJson']);

        // create roles and assign existing permissions
        Role::create(['name' => 'Superadmin']);

        $roleSuperadmin = Role::findByName('Superadmin');
        $roleSuperadmin->givePermissionTo('user.index');
        $roleSuperadmin->givePermissionTo('user.create');
        $roleSuperadmin->givePermissionTo('user.store');
        $roleSuperadmin->givePermissionTo('user.edit');
        $roleSuperadmin->givePermissionTo('user.update');
        $roleSuperadmin->givePermissionTo('user.destroy');

        $roleSuperadmin->givePermissionTo('role.index');
        $roleSuperadmin->givePermissionTo('role.create');
        $roleSuperadmin->givePermissionTo('role.store');
        $roleSuperadmin->givePermissionTo('role.edit');
        $roleSuperadmin->givePermissionTo('role.update');
        $roleSuperadmin->givePermissionTo('role.destroy');
        $roleSuperadmin->givePermissionTo('role.getRoutesAllJson');
        $roleSuperadmin->givePermissionTo('role.getRefreshAndDeleteJson');

        $superadmin = User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $superadmin->assignRole('Superadmin');

        // Ambil semua izin yang terkait dengan peran Superadmin
        $permissionsFromRole = $superadmin->getPermissionsViaRoles();

        // Berikan izin yang ada dalam peran secara langsung ke pengguna
        $superadmin->givePermissionTo($permissionsFromRole);
    }

}
