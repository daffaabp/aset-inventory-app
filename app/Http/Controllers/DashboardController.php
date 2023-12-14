<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('Superadmin')) {
            return view('home_superadmin');
        }

        if ($user->hasRole('Petugas')) {
            return view('home_petugas');
        }

        if ($user->hasRole('Sekretaris Bidang')) {
            // Mengambil data peminjaman yang memiliki status_verifikasi 'Dikirim' dan id_peminjam sesuai dengan user yang login
            $peminjamanDikirim = Peminjaman::where('id_peminjam', $user->id)
                ->where('status_verifikasi', 'Dikirim')
                ->orderBy('created_at', 'desc')
                ->get();

            // Mengambil data peminjaman yang memiliki status_verifikasi 'ACC' dan id_peminjam sesuai dengan user yang login
            $peminjamanACC = Peminjaman::where('id_peminjam', $user->id)
                ->where('status_verifikasi', 'ACC')
                ->orderBy('created_at', 'desc')
                ->get();

            // Mengambil data peminjaman yang memiliki status_verifikasi 'Selesai' dan id_peminjam sesuai dengan user yang login
            $peminjamanSelesai = Peminjaman::where('id_peminjam', $user->id)
                ->where('status_verifikasi', 'Selesai')
                ->orderBy('created_at', 'desc')
                ->get();

            // Mengambil data peminjaman yang memiliki status_verifikasi 'Ditolak' dan id_peminjam sesuai dengan user yang login
            $peminjamanDitolak = Peminjaman::where('id_peminjam', $user->id)
                ->where('status_verifikasi', 'Ditolak')
                ->orderBy('created_at', 'desc')
                ->get();

            $activeTab = 'diproses'; // Tab default

            // Notifikasi peminjaman yang jatuh tempo hari ini yang sudah di-ACC
            $peminjamanJatuhTempo = Peminjaman::where('id_peminjam', $user->id)
                ->where('status_verifikasi', 'ACC')
                ->whereDate('tgl_rencana_kembali', now()->toDateString())
                ->get()->toArray(); // Mengonversi hasil query menjadi array

            $notifikasi = [];

            foreach ($peminjamanJatuhTempo as $peminjaman) {
                $notifikasi[] = [
                    'pesan' => 'Waktu pengembalian aset jatuh pada hari ini, silahkan kembalikan kepada petugas.',
                    'peminjaman_id' => $peminjaman['id_peminjaman'],
                ];
            }

            // Simpan notifikasi pada session
            session(['notifikasi' => $notifikasi]);

            if (!$peminjamanDikirim->isEmpty()) {
                $activeTab = 'diproses';
            } elseif (!$peminjamanACC->isEmpty()) {
                $activeTab = 'diacc';
            } elseif (!$peminjamanSelesai->isEmpty()) {
                $activeTab = 'selesai';
            } elseif (!$peminjamanDitolak->isEmpty()) {
                $activeTab = 'ditolak';
            }

            return view('home_sekretaris_bidang', compact('peminjamanDikirim', 'peminjamanACC', 'peminjamanSelesai', 'peminjamanDitolak', 'activeTab'));
        }

        if ($user->hasRole('Sekretaris Kwarcab')) {
            // Mengambil data peminjaman yang memiliki status_verifikasi 'Dikirim' dan id_peminjam sesuai dengan user yang login
            $peminjamanDikirim = Peminjaman::where('id_peminjam', $user->id)
                ->where('status_verifikasi', 'Dikirim')
                ->orderBy('created_at', 'desc')
                ->get();

            // Mengambil data peminjaman yang memiliki status_verifikasi 'ACC' dan id_peminjam sesuai dengan user yang login
            $peminjamanACC = Peminjaman::where('id_peminjam', $user->id)
                ->where('status_verifikasi', 'ACC')
                ->orderBy('created_at', 'desc')
                ->get();

            // Mengambil data peminjaman yang memiliki status_verifikasi 'Selesai' dan id_peminjam sesuai dengan user yang login
            $peminjamanSelesai = Peminjaman::where('id_peminjam', $user->id)
                ->where('status_verifikasi', 'Selesai')
                ->orderBy('created_at', 'desc')
                ->get();

            // Mengambil data peminjaman yang memiliki status_verifikasi 'Ditolak' dan id_peminjam sesuai dengan user yang login
            $peminjamanDitolak = Peminjaman::where('id_peminjam', $user->id)
                ->where('status_verifikasi', 'Ditolak')
                ->orderBy('created_at', 'desc')
                ->get();

            $activeTab = 'diproses'; // Tab default

            // Notifikasi peminjaman yang jatuh tempo hari ini yang sudah di-ACC
            $peminjamanJatuhTempo = Peminjaman::where('id_peminjam', $user->id)
                ->where('status_verifikasi', 'ACC')
                ->whereDate('tgl_rencana_kembali', now()->toDateString())
                ->get()->toArray(); // Mengonversi hasil query menjadi array

            $notifikasi = [];

            foreach ($peminjamanJatuhTempo as $peminjaman) {
                $notifikasi[] = [
                    'pesan' => 'Waktu pengembalian aset jatuh pada hari ini, silahkan kembalikan kepada petugas.',
                    'peminjaman_id' => $peminjaman['id_peminjaman'],
                ];
            }

            // Simpan notifikasi pada session
            session(['notifikasi' => $notifikasi]);

            if (!$peminjamanDikirim->isEmpty()) {
                $activeTab = 'diproses';
            } elseif (!$peminjamanACC->isEmpty()) {
                $activeTab = 'diacc';
            } elseif (!$peminjamanSelesai->isEmpty()) {
                $activeTab = 'selesai';
            } elseif (!$peminjamanDitolak->isEmpty()) {
                $activeTab = 'ditolak';
            }

            return view('home_sekretaris_kwarcab', compact('peminjamanDikirim', 'peminjamanACC', 'peminjamanSelesai', 'peminjamanDitolak', 'activeTab'));
        }
    }
}
