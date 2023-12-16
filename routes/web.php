<?php

use App\Http\Controllers\AsetGedungController;
use App\Http\Controllers\AsetInventarisRuanganController;
use App\Http\Controllers\AsetKendaraanController;
use App\Http\Controllers\AsetTanahController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\StatusAsetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('home');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', function () {
//     $user = Auth::user();
//     if ($user->hasRole('Superadmin')) {
//         return view('home_superadmin');
//     }
//     if ($user->hasRole('Petugas')) {
//         return view('home_petugas');
//     }
//     if ($user->hasRole('Sekretaris Bidang')) {
//         return view('home_sekretaris_bidang');
//     }
//     if ($user->hasRole('Sekretaris Kwarcab')) {
//         return view('home_sekretaris_kwarcab');
//     }
//     // Default view if no role matches
//     return view('home');

// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('permission:dashboard');

// User Access Management
    Route::get('/user', [UserController::class, 'index'])->name('user.index')->middleware('permission:user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create')->middleware('permission:user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store')->middleware('permission:user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('permission:user.edit');
    Route::patch('/user/{id}/update', [UserController::class, 'update'])->name('user.update')->middleware('permission:user.update');
    Route::delete('/user/destroy{id}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('permission:user.destroy');

// Role Access Management
    Route::get('/role', [RoleController::class, 'index'])->name('role.index')->middleware('permission:role.index');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create')->middleware('permission:role.create');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store')->middleware('permission:role.store');
    Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit')->middleware('permission:role.edit');
    Route::post('/roles/{id}/update', [RoleController::class, 'update'])->name('role.update')->middleware('permission:role.update');
    Route::delete('/role/destroy{id}', [RoleController::class, 'destroy'])->name('role.destroy')->middleware('permission:role.destroy');
    Route::get('/role/getRoutesAll', [RoleController::class, 'getRoutesAllJson'])->name('role.getRoutesAllJson')->middleware('permission:role.getRoutesAllJson');
    Route::get('/role/getRoutesRefreshDelete', [RoleController::class, 'getRefreshAndDeleteJson'])->name('role.getRefreshAndDeleteJson')->middleware('permission:role.getRefreshAndDeleteJson');

// Kelola Bidang
    Route::get('/bidang', [BidangController::class, 'index'])->name('bidang.index')->middleware('permission:bidang.index');
    Route::get('/bidang/create', [BidangController::class, 'create'])->name('bidang.create')->middleware('permission:bidang.create');
    Route::post('/bidang/store', [BidangController::class, 'store'])->name('bidang.store')->middleware('permission:bidang.store');
    Route::get('/bidang/{id}/edit', [BidangController::class, 'edit'])->name('bidang.edit')->middleware('permission:bidang.edit');
    Route::patch('/bidang/{id}/update', [BidangController::class, 'update'])->name('bidang.update')->middleware('permission:bidang.update');
    Route::delete('/bidang/destroy{id}', [BidangController::class, 'destroy'])->name('bidang.destroy')->middleware('permission:bidang.destroy');

// Kelola Status Aset
    Route::get('/status_aset', [StatusAsetController::class, 'index'])->name('status_aset.index')->middleware('permission:status_aset.index');
    Route::get('/status_aset/create', [StatusAsetController::class, 'create'])->name('status_aset.create')->middleware('permission:status_aset.create');
    Route::post('/status_aset/store', [StatusAsetController::class, 'store'])->name('status_aset.store')->middleware('permission:status_aset.store');
    Route::get('/status_aset/{id}/edit', [StatusAsetController::class, 'edit'])->name('status_aset.edit')->middleware('permission:status_aset.edit');
    Route::patch('/status_aset/{id}/update', [StatusAsetController::class, 'update'])->name('status_aset.update')->middleware('permission:status_aset.update');
    Route::delete('/status_aset/destroy{id}', [StatusAsetController::class, 'destroy'])->name('status_aset.destroy')->middleware('permission:status_aset.destroy');

// Kelola Ruangan
    Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index')->middleware('permission:ruangan.index');
    Route::get('/ruangan/create', [RuanganController::class, 'create'])->name('ruangan.create')->middleware('permission:ruangan.create');
    Route::post('/ruangan/store', [RuanganController::class, 'store'])->name('ruangan.store')->middleware('permission:ruangan.store');
    Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit')->middleware('permission:ruangan.edit');
    Route::patch('/ruangan/{id}/update', [RuanganController::class, 'update'])->name('ruangan.update')->middleware('permission:ruangan.update');
    Route::delete('/ruangan/destroy{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy')->middleware('permission:ruangan.destroy');

// Kelola Aset Tanah
    Route::get('/tanah', [AsetTanahController::class, 'index'])->name('tanah.index')->middleware('permission:tanah.index');
    Route::get('/tanah/create', [AsetTanahController::class, 'create'])->name('tanah.create')->middleware('permission:tanah.create');
    Route::post('/tanah/store', [AsetTanahController::class, 'store'])->name('tanah.store')->middleware('permission:tanah.store');
    Route::get('/tanah/{id}/edit', [AsetTanahController::class, 'edit'])->name('tanah.edit')->middleware('permission:tanah.edit');
    Route::patch('/tanah/{id}/update', [AsetTanahController::class, 'update'])->name('tanah.update')->middleware('permission:tanah.update');
    Route::delete('/tanah/destroy/{id}', [AsetTanahController::class, 'destroy'])->name('tanah.destroy')->middleware('permission:tanah.destroy');
    Route::post('/tanah-importExcel', [AsetTanahController::class, 'importExcel'])->name('tanah.importExcel')->middleware('permission:tanah.importExcel');
    Route::get('/tanah-exportExcel', [AsetTanahController::class, 'exportExcel'])->name('tanah.exportExcel')->middleware('permission:tanah.exportExcel');
    Route::get('/tanah-exportPdf', [AsetTanahController::class, 'exportPdf'])->name('tanah.exportPdf')->middleware('permission:tanah.exportPdf');
    Route::get('tanah/showDetail', [AsetTanahController::class, 'showDetail'])->name('tanah.showDetail')->middleware('permission:tanah.showDetail');

// Kelola Aset Gedung
    Route::get('/gedung', [AsetGedungController::class, 'index'])->name('gedung.index')->middleware('permission:gedung.index');
    Route::get('/gedung/create', [AsetGedungController::class, 'create'])->name('gedung.create')->middleware('permission:gedung.create');
    Route::post('/gedung/store', [AsetGedungController::class, 'store'])->name('gedung.store')->middleware('permission:gedung.store');
    Route::get('/gedung/{id}/edit', [AsetGedungController::class, 'edit'])->name('gedung.edit')->middleware('permission:gedung.edit');
    Route::patch('/gedung/{id}/update', [AsetGedungController::class, 'update'])->name('gedung.update')->middleware('permission:gedung.update');
    Route::delete('/gedung/destroy{id}', [AsetGedungController::class, 'destroy'])->name('gedung.destroy')->middleware('permission:gedung.destroy');
    Route::post('/gedung-importExcel', [AsetGedungController::class, 'importExcel'])->name('gedung.importExcel')->middleware('permission:gedung.importExcel');
    Route::get('/gedung-exportExcel', [AsetGedungController::class, 'exportExcel'])->name('gedung.exportExcel')->middleware('permission:gedung.exportExcel');
    Route::get('/gedung-exportPdf', [AsetGedungController::class, 'exportPdf'])->name('gedung.exportPdf')->middleware('permission:gedung.exportPdf');
    Route::get('gedung/showDetail', [AsetGedungController::class, 'showDetail'])->name('gedung.showDetail')->middleware('permission:gedung.showDetail');

// Kelola Aset Kendaraan
    Route::get('/kendaraan', [AsetKendaraanController::class, 'index'])->name('kendaraan.index')->middleware('permission:kendaraan.index');
    Route::get('/kendaraan/create', [AsetKendaraanController::class, 'create'])->name('kendaraan.create')->middleware('permission:kendaraan.create');
    Route::post('/kendaraan/store', [AsetKendaraanController::class, 'store'])->name('kendaraan.store')->middleware('permission:kendaraan.store');
    Route::get('/kendaraan/{id}/edit', [AsetKendaraanController::class, 'edit'])->name('kendaraan.edit')->middleware('permission:kendaraan.edit');
    Route::patch('/kendaraan/{id}/update', [AsetKendaraanController::class, 'update'])->name('kendaraan.update')->middleware('permission:kendaraan.update');
    Route::delete('/kendaraan/destroy{id}', [AsetKendaraanController::class, 'destroy'])->name('kendaraan.destroy')->middleware('permission:kendaraan.destroy');
    Route::post('/kendaraan-importExcel', [AsetKendaraanController::class, 'importExcel'])->name('kendaraan.importExcel')->middleware('permission:kendaraan.importExcel');
    Route::get('/kendaraan-exportExcel', [AsetKendaraanController::class, 'exportExcel'])->name('kendaraan.exportExcel')->middleware('permission:kendaraan.exportExcel');
    Route::get('/kendaraan-exportPdf', [AsetKendaraanController::class, 'exportPdf'])->name('kendaraan.exportPdf')->middleware('permission:kendaraan.exportPdf');
    Route::get('kendaraan/showDetail', [AsetKendaraanController::class, 'showDetail'])->name('kendaraan.showDetail')->middleware('permission:kendaraan.showDetail');

// Kelola Aset Inventaris Ruangan
    Route::get('/inventaris', [AsetInventarisRuanganController::class, 'index'])->name('inventaris.index')->middleware('permission:inventaris.index');
    Route::get('/inventarisMassal', [AsetInventarisRuanganController::class, 'indexMassal'])->name('inventaris.indexMassal')->middleware('permission:inventaris.indexMassal');
    Route::get('/inventaris/create', [AsetInventarisRuanganController::class, 'create'])->name('inventaris.create')->middleware('permission:inventaris.create');
    Route::post('/inventaris/store', [AsetInventarisRuanganController::class, 'store'])->name('inventaris.store')->middleware('permission:inventaris.store');
    Route::get('/inventaris/createMassal', [AsetInventarisRuanganController::class, 'createMassal'])->name('inventaris.createMassal')->middleware('permission:inventaris.createMassal');
    Route::post('/inventaris/storeMassal', [AsetInventarisRuanganController::class, 'storeMassal'])->name('inventaris.storeMassal')->middleware('permission:inventaris.storeMassal');
    Route::get('/inventaris/{id}/edit', [AsetInventarisRuanganController::class, 'edit'])->name('inventaris.edit')->middleware('permission:inventaris.edit');
    Route::patch('/inventaris/{id}/update', [AsetInventarisRuanganController::class, 'update'])->name('inventaris.update')->middleware('permission:inventaris.update');
    Route::delete('/inventaris/destroy{id}', [AsetInventarisRuanganController::class, 'destroy'])->name('inventaris.destroy')->middleware('permission:inventaris.destroy');
    Route::delete('/inventaris/destroyMassal/{grupId}', [AsetInventarisRuanganController::class, 'destroyMassal'])->name('inventaris.destroyMassal')->middleware('permission:inventaris.destroyMassal');
    Route::post('/inventaris-importExcel', [AsetInventarisRuanganController::class, 'importExcel'])->name('inventaris.importExcel')->middleware('permission:inventaris.importExcel');
    Route::get('/inventaris-exportExcel', [AsetInventarisRuanganController::class, 'exportExcel'])->name('inventaris.exportExcel')->middleware('permission:inventaris.exportExcel');
    Route::get('/inventaris-exportPdf', [AsetInventarisRuanganController::class, 'exportPdf'])->name('inventaris.exportPdf')->middleware('permission:inventaris.exportPdf');
    Route::get('inventaris/showDetail', [AsetInventarisRuanganController::class, 'showDetail'])->name('inventaris.showDetail')->middleware('permission:inventaris.showDetail');

// Kelola Peminjaman
    Route::get('/getAset', [PeminjamanController::class, 'getAset'])->name('getAset')->middleware('permission:getAset');
    Route::post('/addAset', [PeminjamanController::class, 'addAset'])->name('addAset')->middleware('permission:addAset');
    Route::post('/cari-aset', [PeminjamanController::class, 'cariAset'])->name('cariAset')->middleware('permission:cariAset');
    Route::get('/peminjaman/index', [PeminjamanController::class, 'index'])->name('peminjaman.index')->middleware('permission:peminjaman.index');
    Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store')->middleware('permission:peminjaman.store');
    Route::get('/verifikasiPeminjaman', [PeminjamanController::class, 'verifikasiPeminjaman'])->name('verifikasiPeminjaman')->middleware('permission:verifikasiPeminjaman');
    Route::get('/verifikasiPeminjaman/{id}/details', [PeminjamanController::class, 'verifikasiPeminjamanDetails'])->name('verifikasiPeminjamanDetails')->middleware('permission:verifikasiPeminjamanDetails');
    Route::post('/verifikasi-peminjaman/{id_peminjaman}', [PeminjamanController::class, 'processVerification'])->name('processVerification')->middleware('permission:processVerification');
    Route::get('/riwayatPeminjaman', [PeminjamanController::class, 'riwayatPeminjaman'])->name('riwayatPeminjaman')->middleware('permission:riwayatPeminjaman');
});

require __DIR__ . '/auth.php';
