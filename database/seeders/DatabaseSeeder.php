<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Database\Seeders\StatusAsetSeeder;
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

        Permission::create(['name' => 'bidang.index']);
        Permission::create(['name' => 'bidang.create']);
        Permission::create(['name' => 'bidang.store']);
        Permission::create(['name' => 'bidang.edit']);
        Permission::create(['name' => 'bidang.update']);
        Permission::create(['name' => 'bidang.destroy']);

        Permission::create(['name' => 'status_aset.index']);
        Permission::create(['name' => 'status_aset.create']);
        Permission::create(['name' => 'status_aset.store']);
        Permission::create(['name' => 'status_aset.edit']);
        Permission::create(['name' => 'status_aset.update']);
        Permission::create(['name' => 'status_aset.destroy']);

        Permission::create(['name' => 'ruangan.index']);
        Permission::create(['name' => 'ruangan.create']);
        Permission::create(['name' => 'ruangan.store']);
        Permission::create(['name' => 'ruangan.edit']);
        Permission::create(['name' => 'ruangan.update']);
        Permission::create(['name' => 'ruangan.destroy']);

        Permission::create(['name' => 'tanah.index']);
        Permission::create(['name' => 'tanah.create']);
        Permission::create(['name' => 'tanah.store']);
        Permission::create(['name' => 'tanah.edit']);
        Permission::create(['name' => 'tanah.update']);
        Permission::create(['name' => 'tanah.destroy']);

        Permission::create(['name' => 'gedung.index']);
        Permission::create(['name' => 'gedung.create']);
        Permission::create(['name' => 'gedung.store']);
        Permission::create(['name' => 'gedung.edit']);
        Permission::create(['name' => 'gedung.update']);
        Permission::create(['name' => 'gedung.destroy']);

        Permission::create(['name' => 'kendaraan.index']);
        Permission::create(['name' => 'kendaraan.create']);
        Permission::create(['name' => 'kendaraan.store']);
        Permission::create(['name' => 'kendaraan.edit']);
        Permission::create(['name' => 'kendaraan.update']);
        Permission::create(['name' => 'kendaraan.destroy']);

        Permission::create(['name' => 'inventaris.index']);
        Permission::create(['name' => 'inventaris.indexMassal']);
        Permission::create(['name' => 'inventaris.create']);
        Permission::create(['name' => 'inventaris.store']);
        Permission::create(['name' => 'inventaris.createMassal']);
        Permission::create(['name' => 'inventaris.storeMassal']);
        Permission::create(['name' => 'inventaris.edit']);
        Permission::create(['name' => 'inventaris.update']);
        Permission::create(['name' => 'inventaris.destroy']);
        Permission::create(['name' => 'inventaris.destroyMassal']);

        Permission::create(['name' => 'getAset']);
        Permission::create(['name' => 'addAset']);
        Permission::create(['name' => 'peminjaman.index']);
        Permission::create(['name' => 'peminjaman.store']);
        Permission::create(['name' => 'verifikasiPeminjaman']);
        Permission::create(['name' => 'verifikasiPeminjamanDetails']);
        Permission::create(['name' => 'processVerification']);
        Permission::create(['name' => 'riwayatPeminjaman']);

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

        Role::create(['name' => 'Sekretaris Bidang']);
        $roleSekretarisBidang = Role::findByName('Sekretaris Bidang');
        $roleSekretarisBidang->givePermissionTo('getAset');
        $roleSekretarisBidang->givePermissionTo('addAset');
        $roleSekretarisBidang->givePermissionTo('peminjaman.index');
        $roleSekretarisBidang->givePermissionTo('peminjaman.store');
        $roleSekretarisBidang->givePermissionTo('verifikasiPeminjamanDetails');
        $roleSekretarisBidang->givePermissionTo('riwayatPeminjaman');

        Role::create(['name' => 'Sekretaris Kwarcab']);
        $roleSekretarisKwarcab = Role::findByName('Sekretaris Kwarcab');
        $roleSekretarisKwarcab->givePermissionTo('getAset');
        $roleSekretarisKwarcab->givePermissionTo('addAset');
        $roleSekretarisKwarcab->givePermissionTo('peminjaman.index');
        $roleSekretarisKwarcab->givePermissionTo('peminjaman.store');
        $roleSekretarisKwarcab->givePermissionTo('verifikasiPeminjamanDetails');
        $roleSekretarisKwarcab->givePermissionTo('riwayatPeminjaman');

        Role::create(['name' => 'Petugas']);
        $rolePetugas = Role::findByName('Petugas');
        $rolePetugas->givePermissionTo('bidang.index');
        $rolePetugas->givePermissionTo('bidang.create');
        $rolePetugas->givePermissionTo('bidang.store');
        $rolePetugas->givePermissionTo('bidang.edit');
        $rolePetugas->givePermissionTo('bidang.update');
        $rolePetugas->givePermissionTo('bidang.destroy');

        $rolePetugas->givePermissionTo('status_aset.index');
        $rolePetugas->givePermissionTo('status_aset.create');
        $rolePetugas->givePermissionTo('status_aset.store');
        $rolePetugas->givePermissionTo('status_aset.edit');
        $rolePetugas->givePermissionTo('status_aset.update');
        $rolePetugas->givePermissionTo('status_aset.destroy');

        $rolePetugas->givePermissionTo('ruangan.index');
        $rolePetugas->givePermissionTo('ruangan.create');
        $rolePetugas->givePermissionTo('ruangan.store');
        $rolePetugas->givePermissionTo('ruangan.edit');
        $rolePetugas->givePermissionTo('ruangan.update');
        $rolePetugas->givePermissionTo('ruangan.destroy');

        $rolePetugas->givePermissionTo('tanah.index');
        $rolePetugas->givePermissionTo('tanah.create');
        $rolePetugas->givePermissionTo('tanah.store');
        $rolePetugas->givePermissionTo('tanah.edit');
        $rolePetugas->givePermissionTo('tanah.update');
        $rolePetugas->givePermissionTo('tanah.destroy');

        $rolePetugas->givePermissionTo('gedung.index');
        $rolePetugas->givePermissionTo('gedung.create');
        $rolePetugas->givePermissionTo('gedung.store');
        $rolePetugas->givePermissionTo('gedung.edit');
        $rolePetugas->givePermissionTo('gedung.update');
        $rolePetugas->givePermissionTo('gedung.destroy');

        $rolePetugas->givePermissionTo('kendaraan.index');
        $rolePetugas->givePermissionTo('kendaraan.create');
        $rolePetugas->givePermissionTo('kendaraan.store');
        $rolePetugas->givePermissionTo('kendaraan.edit');
        $rolePetugas->givePermissionTo('kendaraan.update');
        $rolePetugas->givePermissionTo('kendaraan.destroy');

        $rolePetugas->givePermissionTo('inventaris.index');
        $rolePetugas->givePermissionTo('inventaris.indexMassal');
        $rolePetugas->givePermissionTo('inventaris.create');
        $rolePetugas->givePermissionTo('inventaris.store');
        $rolePetugas->givePermissionTo('inventaris.createMassal');
        $rolePetugas->givePermissionTo('inventaris.storeMassal');
        $rolePetugas->givePermissionTo('inventaris.edit');
        $rolePetugas->givePermissionTo('inventaris.update');
        $rolePetugas->givePermissionTo('inventaris.destroy');
        $rolePetugas->givePermissionTo('inventaris.destroyMassal');

        $rolePetugas->givePermissionTo('verifikasiPeminjaman');
        $rolePetugas->givePermissionTo('verifikasiPeminjamanDetails');
        $rolePetugas->givePermissionTo('processVerification');
        $rolePetugas->givePermissionTo('riwayatPeminjaman');

        $superadmin = User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $superadmin->assignRole('Superadmin');

        $petugas = User::create([
            'name' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $petugas->assignRole('Petugas');

        $sekretaris_bidang_binamuda = User::create([
            'name' => 'Sekretaris Bidang Binamuda',
            'email' => 'sekbid_binamuda@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $sekretaris_bidang_binamuda->assignRole('Sekretaris Bidang');

        $sekretaris_kwarcab = User::create([
            'name' => 'Sekretaris Kwarcab',
            'email' => 'sekcab@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $sekretaris_kwarcab->assignRole('Sekretaris Kwarcab');

        // Ambil semua izin yang terkait dengan peran Superadmin
        $permissionsFromRole = $superadmin->getPermissionsViaRoles();
        $permissionsFromRole = $petugas->getPermissionsViaRoles();
        $permissionsFromRole = $sekretaris_bidang_binamuda->getPermissionsViaRoles();
        $permissionsFromRole = $sekretaris_kwarcab->getPermissionsViaRoles();

        // Berikan izin yang ada dalam peran secara langsung ke pengguna
        $superadmin->givePermissionTo($permissionsFromRole);
        $petugas->givePermissionTo($permissionsFromRole);
        $sekretaris_bidang_binamuda->givePermissionTo($permissionsFromRole);
        $sekretaris_kwarcab->givePermissionTo($permissionsFromRole);

        $this->call([
            StatusAsetSeeder::class,
        ]);
    }
}
