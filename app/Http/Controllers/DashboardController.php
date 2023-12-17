<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\AsetTanah;
use App\Models\AsetGedung;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\AsetKendaraan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AsetInventarisRuangan;

class DashboardController extends Controller
{
    public function countTotalAset()
    {
        $totalAsetTanah = AsetTanah::count();
        $totalAsetGedung = AsetGedung::count();
        $totalAsetKendaraan = AsetKendaraan::count();
        $totalAsetInventarisRuangan = AsetInventarisRuangan::count();

        return compact('totalAsetTanah', 'totalAsetGedung', 'totalAsetKendaraan', 'totalAsetInventarisRuangan');
    }

    private function prepareChartData($completedPeminjaman, $selectedYear)
    {
        // Prepare an array with months from January to December
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('Y-m', mktime(0, 0, 0, $i, 1));
        }

        // Initialize an array with total peminjaman for each month
        $totals = array_fill_keys($months, 0);

        // Populate the totals array with data from the database
        foreach ($completedPeminjaman as $peminjaman) {
            $totals[$peminjaman->month] = $peminjaman->total;
        }

        // Prepare data for the chart
        $chartData = [
            'months' => array_keys($totals),
            'totals' => array_values($totals),
        ];

        return $chartData;
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole('Superadmin')) {
            $totalAset = $this->countTotalAset();

            // Get the selected year from the request, default to the current year
            $selectedYear = $request->input('year', date('Y'));

           // Get completed peminjaman data by month for the selected year
            $completedPeminjaman = Peminjaman::where('status_verifikasi', 'Selesai')
            ->whereYear('tgl_pengajuan', $selectedYear)
            ->select(DB::raw('DATE_FORMAT(tgl_pengajuan, "%Y-%m") as month'), DB::raw('count(*) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

            $chartData = $this->prepareChartData($completedPeminjaman, $selectedYear);

            // Mendapatkan data untuk grafik donat
            $dataAsetTanah = AsetTanah::select('status_aset.status_aset', DB::raw('COUNT(*) as total'))
                ->join('status_aset', 'aset_tanah.id_status_aset', '=', 'status_aset.id_status_aset')
                ->groupBy('status_aset.status_aset')
                ->get()
                ->pluck('total', 'status_aset');

            $dataAsetGedung = AsetGedung::select('status_aset.status_aset', \DB::raw('COUNT(*) as total'))
                ->join('status_aset', 'aset_gedung.id_status_aset', '=', 'status_aset.id_status_aset')
                ->groupBy('status_aset.status_aset')
                ->get()
                ->pluck('total', 'status_aset');

            $dataAsetKendaraan = AsetKendaraan::select('status_aset.status_aset', \DB::raw('COUNT(*) as total'))
                ->join('status_aset', 'aset_kendaraan.id_status_aset', '=', 'status_aset.id_status_aset')
                ->groupBy('status_aset.status_aset')
                ->get()
                ->pluck('total', 'status_aset');

            $dataAsetInventarisRuangan = AsetInventarisRuangan::select('status_aset.status_aset', \DB::raw('COUNT(*) as total'))
                ->join('status_aset', 'aset_inventaris_ruangan.id_status_aset', '=', 'status_aset.id_status_aset')
                ->groupBy('status_aset.status_aset')
                ->get()
                ->pluck('total', 'status_aset');

            $dataPeminjamanSelesai = Peminjaman::where('status_verifikasi', 'Selesai')
                ->selectRaw('DATE_FORMAT(tgl_rencana_pinjam, "%Y-%m") as month, COUNT(*) as total')
                ->groupBy('month')
                ->get()
                ->pluck('total', 'month');

            return view('home_superadmin', compact('totalAset', 'dataAsetTanah', 'dataAsetGedung', 'dataAsetKendaraan', 'dataAsetInventarisRuangan','chartData', 'selectedYear'));
        }

        if ($user->hasRole('Petugas')) {
            $totalAset = $this->countTotalAset();

            // Get the selected year from the request, default to the current year
            $selectedYear = $request->input('year', date('Y'));

           // Get completed peminjaman data by month for the selected year
            $completedPeminjaman = Peminjaman::where('status_verifikasi', 'Selesai')
            ->whereYear('tgl_pengajuan', $selectedYear)
            ->select(DB::raw('DATE_FORMAT(tgl_pengajuan, "%Y-%m") as month'), DB::raw('count(*) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

            $chartData = $this->prepareChartData($completedPeminjaman, $selectedYear);

            // Mendapatkan data untuk grafik donat
            $dataAsetTanah = AsetTanah::select('status_aset.status_aset', DB::raw('COUNT(*) as total'))
                ->join('status_aset', 'aset_tanah.id_status_aset', '=', 'status_aset.id_status_aset')
                ->groupBy('status_aset.status_aset')
                ->get()
                ->pluck('total', 'status_aset');

            $dataAsetGedung = AsetGedung::select('status_aset.status_aset', \DB::raw('COUNT(*) as total'))
                ->join('status_aset', 'aset_gedung.id_status_aset', '=', 'status_aset.id_status_aset')
                ->groupBy('status_aset.status_aset')
                ->get()
                ->pluck('total', 'status_aset');

            $dataAsetKendaraan = AsetKendaraan::select('status_aset.status_aset', \DB::raw('COUNT(*) as total'))
                ->join('status_aset', 'aset_kendaraan.id_status_aset', '=', 'status_aset.id_status_aset')
                ->groupBy('status_aset.status_aset')
                ->get()
                ->pluck('total', 'status_aset');

            $dataAsetInventarisRuangan = AsetInventarisRuangan::select('status_aset.status_aset', \DB::raw('COUNT(*) as total'))
                ->join('status_aset', 'aset_inventaris_ruangan.id_status_aset', '=', 'status_aset.id_status_aset')
                ->groupBy('status_aset.status_aset')
                ->get()
                ->pluck('total', 'status_aset');

            $dataPeminjamanSelesai = Peminjaman::where('status_verifikasi', 'Selesai')
                ->selectRaw('DATE_FORMAT(tgl_rencana_pinjam, "%Y-%m") as month, COUNT(*) as total')
                ->groupBy('month')
                ->get()
                ->pluck('total', 'month');

            return view('home_petugas', compact('totalAset', 'dataAsetTanah', 'dataAsetGedung', 'dataAsetKendaraan', 'dataAsetInventarisRuangan','chartData', 'selectedYear'));
        }

        if ($user->hasRole('Sekretaris Bidang')) {
            // Mengambil data peminjaman yang memiliki status_verifikasi 'Dikirim' dan id_peminjam sesuai dengan user yang login
            $peminjamanDikirim = Peminjaman::where('id_peminjam', $user->id)
                ->where('status_verifikasi', 'Dikirim')
                ->where('tgl_rencana_kembali', '>', now())
                ->orderBy('created_at', 'desc')
                ->get();

            // Mengambil data peminjaman yang memiliki status_verifikasi 'ACC' dan id_peminjam sesuai dengan user yang login
            $peminjamanACC = Peminjaman::with('usersPetugas')
                ->where('id_peminjam', $user->id)
                ->where('tgl_rencana_kembali', '>', now())
                ->where('status_verifikasi', 'ACC')
                ->orderBy('created_at', 'desc')
                ->get();

            // Mengambil data peminjaman yang memiliki status_verifikasi 'Selesai' dan id_peminjam sesuai dengan user yang login
            $peminjamanSelesai = Peminjaman::where('id_peminjam', $user->id)
                ->where('tgl_rencana_kembali', '>', now())
                ->where('status_verifikasi', 'Selesai')
                ->orderBy('created_at', 'desc')
                ->get();

            // Mengambil data peminjaman yang memiliki status_verifikasi 'Ditolak' dan id_peminjam sesuai dengan user yang login
            $peminjamanDitolak = Peminjaman::where('id_peminjam', $user->id)
                 ->where('tgl_rencana_kembali', '>', now())
                ->where('status_verifikasi', 'Ditolak')
                ->orderBy('created_at', 'desc')
                ->get();

            $activeTab = 'diproses'; // Tab default

            // Notifikasi peminjaman yang jatuh tempo hari ini yang sudah di-ACC
            $peminjamanJatuhTempo = Peminjaman::where('id_peminjam', $user->id)
                ->where('status_verifikasi', 'ACC')
                ->whereDate('tgl_rencana_kembali', now()->toDateString())
                ->get()->toArray();

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
            ->where('tgl_rencana_kembali', '>', now())
            ->orderBy('created_at', 'desc')
            ->get();

            // Mengambil data peminjaman yang memiliki status_verifikasi 'ACC' dan id_peminjam sesuai dengan user yang login
            $peminjamanACC = Peminjaman::with('usersPetugas')
                ->where('id_peminjam', $user->id)
                ->where('tgl_rencana_kembali', '>', now())
                ->where('status_verifikasi', 'ACC')
                ->orderBy('created_at', 'desc')
                ->get();

            // Mengambil data peminjaman yang memiliki status_verifikasi 'Selesai' dan id_peminjam sesuai dengan user yang login
            $peminjamanSelesai = Peminjaman::where('id_peminjam', $user->id)
                ->where('tgl_rencana_kembali', '>', now())
                ->where('status_verifikasi', 'Selesai')
                ->orderBy('created_at', 'desc')
                ->get();

            // Mengambil data peminjaman yang memiliki status_verifikasi 'Ditolak' dan id_peminjam sesuai dengan user yang login
            $peminjamanDitolak = Peminjaman::where('id_peminjam', $user->id)
                ->where('tgl_rencana_kembali', '>', now())
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