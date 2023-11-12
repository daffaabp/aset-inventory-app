<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AsetGedung;
use App\Models\AsetInventarisRuangan;
use App\Models\AsetKendaraan;
use App\Models\AsetTanah;
use App\Models\Peminjaman;
use App\Models\RiwayatPeminjamanGedung;
use App\Models\RiwayatPeminjamanInventarisRuangan;
use App\Models\RiwayatPeminjamanKendaraan;
use App\Models\RiwayatPeminjamanTanah;
use App\Models\StatusAset;
use id;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function create()
    {
        return view('peminjaman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kegunaan' => 'required|string|max:255',
            'tgl_rencana_pinjam' => 'required|date',
            'tgl_rencana_kembali' => 'required|date|after:tgl_rencana_pinjam',
        ]);

        // echo '<pre>';
        // print_r($request->all());
        // die;

        $peminjaman = new Peminjaman;
        $peminjaman->id_peminjam = auth()->user()->id;
        $peminjaman->kegunaan = $request->kegunaan;

        $peminjaman->tgl_pengajuan = now()->format('Y-m-d H:i:s');

        $peminjaman->tgl_rencana_pinjam = $request->tgl_rencana_pinjam;
        $peminjaman->tgl_rencana_kembali = $request->tgl_rencana_kembali;

        if ($peminjaman->save()) {
            if (!empty($request->aset_tanah)) {
                if (count($request->aset_tanah) != 0) {
                    foreach ($request->aset_tanah as $id_aset_tanah) {
                        // disini kita ambil data aset tanah berdasarkan id_aset_tanahnya
                        $asetTanah = AsetTanah::find($id_aset_tanah);

                        // simpan data aset ke riwayat_peminjaman_tanah
                        $riwayatPeminjaman = new RiwayatPeminjamanTanah();
                        $riwayatPeminjaman->id_peminjaman = $peminjaman->id_peminjaman; // Menggunakan ID peminjaman yang telah diambil

                        $riwayatPeminjaman->id_aset_tanah = $asetTanah->id_aset_tanah;
                        $riwayatPeminjaman->id_status_aset = $asetTanah->id_status_aset;
                        $riwayatPeminjaman->kode_aset = $asetTanah->kode_aset;
                        $riwayatPeminjaman->nama = $asetTanah->nama;
                        $riwayatPeminjaman->luas = $asetTanah->luas;
                        $riwayatPeminjaman->letak_tanah = $asetTanah->letak_tanah;
                        $riwayatPeminjaman->hak = $asetTanah->hak;
                        $riwayatPeminjaman->tanggal_sertifikat = $asetTanah->tanggal_sertifikat;
                        $riwayatPeminjaman->no_sertifikat = $asetTanah->no_sertifikat;
                        $riwayatPeminjaman->penggunaan = $asetTanah->penggunaan;
                        $riwayatPeminjaman->harga = $asetTanah->harga;
                        $riwayatPeminjaman->keterangan = $asetTanah->keterangan;

                        // Set atribut tgl_perubahan_status dan kegunaan
                        $riwayatPeminjaman->status_verifikasi = 'Dikirim';
                        $riwayatPeminjaman->tgl_perubahan_status = $peminjaman->created_at;
                        $riwayatPeminjaman->kegunaan = $peminjaman->kegunaan;

                        // Simpan riwayat peminjaman
                        $riwayatPeminjaman->save();
                    }
                }
            }

            if (!empty($request->aset_gedung)) {
                if (count($request->aset_gedung) != 0) {
                    foreach ($request->aset_gedung as $id_aset_gedung) {
                        // disini kita ambil data aset tanah berdasarkan id_aset_gedung nya
                        $asetGedung = AsetGedung::find($id_aset_gedung);

                        // simpan data aset ke riwayat_peminjaman_tanah
                        $riwayatPeminjaman = new RiwayatPeminjamanGedung();
                        $riwayatPeminjaman->id_peminjaman = $peminjaman->id_peminjaman; // Menggunakan ID peminjaman yang telah diambil

                        $riwayatPeminjaman->id_aset_gedung = $asetGedung->id_aset_gedung;
                        $riwayatPeminjaman->id_status_aset = $asetGedung->id_status_aset;
                        $riwayatPeminjaman->kode_aset = $asetGedung->kode_aset;
                        $riwayatPeminjaman->nama = $asetGedung->nama;
                        $riwayatPeminjaman->kondisi = $asetGedung->kondisi;
                        $riwayatPeminjaman->bertingkat = $asetGedung->bertingkat;
                        $riwayatPeminjaman->beton = $asetGedung->beton;
                        $riwayatPeminjaman->luas_lantai = $asetGedung->luas_lantai;
                        $riwayatPeminjaman->lokasi = $asetGedung->lokasi;
                        $riwayatPeminjaman->tahun_dok = $asetGedung->tahun_dok;
                        $riwayatPeminjaman->nomor_dok = $asetGedung->nomor_dok;
                        $riwayatPeminjaman->luas = $asetGedung->luas;
                        $riwayatPeminjaman->hak = $asetGedung->hak;
                        $riwayatPeminjaman->harga = $asetGedung->harga;
                        $riwayatPeminjaman->keterangan = $asetGedung->keterangan;

                        // Set atribut tgl_perubahan_status dan kegunaan
                        $riwayatPeminjaman->status_verifikasi = 'Dikirim';
                        $riwayatPeminjaman->tgl_perubahan_status = $peminjaman->created_at;
                        $riwayatPeminjaman->kegunaan = $peminjaman->kegunaan;

                        // Simpan riwayat peminjaman
                        $riwayatPeminjaman->save();
                    }
                }
            }

            if (!empty($request->aset_kendaraan)) {
                if (count($request->aset_kendaraan) != 0) {
                    foreach ($request->aset_kendaraan as $id_aset_kendaraan) {
                        // disini kita ambil data aset tanah berdasarkan id_aset_kendaraan nya
                        $asetKendaraan = AsetKendaraan::find($id_aset_kendaraan);

                        // simpan data aset ke riwayat_peminjaman_tanah
                        $riwayatPeminjaman = new RiwayatPeminjamanKendaraan();
                        $riwayatPeminjaman->id_peminjaman = $peminjaman->id_peminjaman; // Menggunakan ID peminjaman yang telah diambil

                        $riwayatPeminjaman->id_aset_kendaraan = $asetKendaraan->id_aset_kendaraan;
                        $riwayatPeminjaman->id_status_aset = $asetKendaraan->id_status_aset;
                        $riwayatPeminjaman->kode_aset = $asetKendaraan->kode_aset;
                        $riwayatPeminjaman->nama = $asetKendaraan->nama;
                        $riwayatPeminjaman->merk = $asetKendaraan->merk;
                        $riwayatPeminjaman->type = $asetKendaraan->type;
                        $riwayatPeminjaman->cylinder = $asetKendaraan->cylinder;
                        $riwayatPeminjaman->warna = $asetKendaraan->warna;
                        $riwayatPeminjaman->no_rangka = $asetKendaraan->no_rangka;
                        $riwayatPeminjaman->no_mesin = $asetKendaraan->no_mesin;
                        $riwayatPeminjaman->thn_pembuatan = $asetKendaraan->thn_pembuatan;
                        $riwayatPeminjaman->thn_pembelian = $asetKendaraan->thn_pembelian;
                        $riwayatPeminjaman->no_polisi = $asetKendaraan->no_polisi;
                        $riwayatPeminjaman->tgl_bpkb = $asetKendaraan->tgl_bpkb;
                        $riwayatPeminjaman->no_bpkb = $asetKendaraan->no_bpkb;
                        $riwayatPeminjaman->harga = $asetKendaraan->harga;
                        $riwayatPeminjaman->keterangan = $asetKendaraan->keterangan;

                        // Set atribut tgl_perubahan_status dan kegunaan
                        $riwayatPeminjaman->status_verifikasi = 'Dikirim';
                        $riwayatPeminjaman->tgl_perubahan_status = $peminjaman->created_at;
                        $riwayatPeminjaman->kegunaan = $peminjaman->kegunaan;

                        // Simpan riwayat peminjaman
                        $riwayatPeminjaman->save();
                    }
                }
            }

            if (!empty($request->aset_inventaris_ruangan)) {
                if (count($request->aset_inventaris_ruangan) != 0) {
                    foreach ($request->aset_inventaris_ruangan as $id_aset_inventaris_ruangan) {
                        // disini kita ambil data aset tanah berdasarkan id_aset_kendaraan nya
                        $asetInventarisRuangan = AsetInventarisRuangan::find($id_aset_inventaris_ruangan);

                        // simpan data aset ke riwayat_peminjaman_tanah
                        $riwayatPeminjaman = new RiwayatPeminjamanInventarisRuangan();
                        $riwayatPeminjaman->id_peminjaman = $peminjaman->id_peminjaman; // Menggunakan ID peminjaman yang telah diambil

                        $riwayatPeminjaman->id_aset_inventaris_ruangan = $asetInventarisRuangan->id_aset_inventaris_ruangan;
                        $riwayatPeminjaman->id_status_aset = $asetInventarisRuangan->id_status_aset;
                        $riwayatPeminjaman->kode_aset = $asetInventarisRuangan->kode_aset;
                        $riwayatPeminjaman->nama = $asetInventarisRuangan->nama;
                        $riwayatPeminjaman->merk = $asetInventarisRuangan->merk;
                        $riwayatPeminjaman->volume = $asetInventarisRuangan->volume;
                        $riwayatPeminjaman->bahan = $asetInventarisRuangan->bahan;
                        $riwayatPeminjaman->tahun = $asetInventarisRuangan->tahun;
                        $riwayatPeminjaman->harga = $asetInventarisRuangan->harga;
                        $riwayatPeminjaman->keterangan = $asetInventarisRuangan->keterangan;
                        $riwayatPeminjaman->jumlah = $asetInventarisRuangan->jumlah;

                        // Set atribut tgl_perubahan_status dan kegunaan
                        $riwayatPeminjaman->status_verifikasi = 'Dikirim';
                        $riwayatPeminjaman->tgl_perubahan_status = $peminjaman->created_at;
                        $riwayatPeminjaman->kegunaan = $peminjaman->kegunaan;

                        // Simpan riwayat peminjaman
                        $riwayatPeminjaman->save();
                    }
                }
            }

            return redirect()->route('riwayatPeminjaman')->with('success', 'Peminjaman berhasil dibuat.');

        } else {
            return redirect()->back()->with('error', 'Gagal membuat peminjaman.');
        }
    }

    public function verifikasiPeminjaman()
    {
        $peminjaman = Peminjaman::with('peminjam')
            ->where('status_verifikasi', '!=', 'Selesai')
            ->get();
        return view('peminjaman.verifikasiPeminjaman', compact('peminjaman'));
    }

    public function verifikasiPeminjamanDetails($id_peminjaman)
    {
        // Mendapatkan riwayat peminjaman tanah sesuai dengan ID peminjaman
        $peminjaman = Peminjaman::find($id_peminjaman);

        //mengambil status_verifikasi untuk digunakan dalam klausa where di pencarian riwayat peminjaman
        $statusverifikasi = $peminjaman->status_verifikasi;

        // get all data peminjaman tanah
        $riwayatPeminjamanTanah = RiwayatPeminjamanTanah::with('statusAset')
            ->where('id_peminjaman', $id_peminjaman)
            ->where('status_verifikasi', '=', $statusverifikasi)
            ->get();

        //get all data peminjaman gedung
        $riwayatPeminjamanGedung = RiwayatPeminjamanGedung::with('statusAset')
            ->where('id_peminjaman', $id_peminjaman)
            ->where('status_verifikasi', '=', $statusverifikasi)
            ->get();

        //get all data peminjaman kendaraan
        $riwayatPeminjamanKendaraan = RiwayatPeminjamanKendaraan::with('statusAset')
            ->where('id_peminjaman', $id_peminjaman)
            ->where('status_verifikasi', '=', $statusverifikasi)
            ->get();

        //get all data peminjaman inventaris ruangan
        $riwayatPeminjamanInventarisRuangan = RiwayatPeminjamanInventarisRuangan::with('statusAset')
            ->where('id_peminjaman', $id_peminjaman)
            ->where('status_verifikasi', '=', $statusverifikasi)
            ->get();
        $status_aset = StatusAset::all();

        return view('peminjaman.verifikasiPeminjamanDetails', [
            'peminjaman' => $peminjaman,
            'riwayatPeminjamanTanah' => $riwayatPeminjamanTanah,
            'riwayatPeminjamanGedung' => $riwayatPeminjamanGedung,
            'riwayatPeminjamanKendaraan' => $riwayatPeminjamanKendaraan,
            'riwayatPeminjamanInventarisRuangan' => $riwayatPeminjamanInventarisRuangan,
            'status_aset' => $status_aset,
        ]);
        return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan.');
    }

    public function processVerification(Request $request, $id_peminjaman)
    {
        $peminjaman = Peminjaman::find($id_peminjaman);
        // dd($request->all());

        if ($request->has('accept')) {
            $status = 'ACC';
            $peminjaman->tgl_acc = now();
            $peminjaman->id_petugas = auth()->user()->id;

        } elseif ($request->has('reject')) {
            $status = 'Ditolak';
            $peminjaman->tgl_acc = null;
            $peminjaman->status_verifikasi = $status;
            $peminjaman->save();

            $riwayatPeminjamanTanah = RiwayatPeminjamanTanah::where('id_peminjaman', $id_peminjaman)->get();
            $riwayatPeminjamanGedung = RiwayatPeminjamanGedung::where('id_peminjaman', $id_peminjaman)->get();
            $riwayatPeminjamanKendaraan = RiwayatPeminjamanKendaraan::where('id_peminjaman', $id_peminjaman)->get();
            $riwayatPeminjamanInventarisRuangan = RiwayatPeminjamanInventarisRuangan::where('id_peminjaman', $id_peminjaman)->get();

            foreach ($riwayatPeminjamanTanah as $riwayat) {
                $riwayat->status_verifikasi = $status;
                $riwayat->save();
            }

            foreach ($riwayatPeminjamanGedung as $riwayat) {
                $riwayat->status_verifikasi = $status;
                $riwayat->save();
            }

            foreach ($riwayatPeminjamanKendaraan as $riwayat) {
                $riwayat->status_verifikasi = $status;
                $riwayat->save();
            }

            foreach ($riwayatPeminjamanInventarisRuangan as $riwayat) {
                $riwayat->status_verifikasi = $status;
                $riwayat->save();
            }
            return redirect()->route('verifikasiPeminjaman')->with('error', 'Peminjaman telah ditolak.');

        } elseif ($request->has('finish')) {
            $status = 'Selesai';
            $peminjaman->status_verifikasi = $status;
            $peminjaman->tgl_pengembalian = now();
            $peminjaman->save();

            $riwayatPeminjamanTanah = RiwayatPeminjamanTanah::where('id_peminjaman', $id_peminjaman)->get();
            $riwayatPeminjamanGedung = RiwayatPeminjamanGedung::where('id_peminjaman', $id_peminjaman)->get();
            $riwayatPeminjamanKendaraan = RiwayatPeminjamanKendaraan::where('id_peminjaman', $id_peminjaman)->get();
            $riwayatPeminjamanInventarisRuangan = RiwayatPeminjamanInventarisRuangan::where('id_peminjaman', $id_peminjaman)->get();

            foreach ($riwayatPeminjamanTanah as $key => $aset) {
                $riwayatData = $request->input('riwayatPeminjamanTanah');
                $statusAsetId = $riwayatData['status'][$key] ?? null;

                if ($statusAsetId !== null) {
                    // Implementasi proses insert ke tabel riwayat_peminjaman_tanah
                    $newRiwayatPeminjaman = new RiwayatPeminjamanTanah();
                    $newRiwayatPeminjaman->id_peminjaman = $id_peminjaman;
                    $newRiwayatPeminjaman->id_aset_tanah = $aset->id_aset_tanah;
                    $newRiwayatPeminjaman->kode_aset = $aset->kode_aset;
                    $newRiwayatPeminjaman->nama = $aset->nama;
                    $newRiwayatPeminjaman->luas = $aset->luas;
                    $newRiwayatPeminjaman->letak_tanah = $aset->letak_tanah;
                    $newRiwayatPeminjaman->hak = $aset->hak;
                    $newRiwayatPeminjaman->tanggal_sertifikat = $aset->tanggal_sertifikat;
                    $newRiwayatPeminjaman->no_sertifikat = $aset->no_sertifikat;
                    $newRiwayatPeminjaman->penggunaan = $aset->penggunaan;
                    $newRiwayatPeminjaman->harga = $aset->harga;
                    $newRiwayatPeminjaman->keterangan = $aset->keterangan;

                    // Set atribut tgl_perubahan_status dan kegunaan
                    $newRiwayatPeminjaman->tgl_perubahan_status = $peminjaman->created_at;
                    $newRiwayatPeminjaman->kegunaan = $peminjaman->kegunaan;

                    $newRiwayatPeminjaman->id_status_aset = $statusAsetId; // Ambil status dari form
                    $newRiwayatPeminjaman->status_verifikasi = 'Selesai';
                    $newRiwayatPeminjaman->save();

                    // Lakukan proses perubahan status pada aset_tanah
                    $asetTanah = AsetTanah::find($aset->id_aset_tanah);
                    $asetTanah->id_status_aset = $statusAsetId;
                    $asetTanah->save();
                }
            }

            foreach ($riwayatPeminjamanGedung as $key => $aset) {
                $riwayatData = $request->input('riwayatPeminjamanGedung');
                $statusAsetId = $riwayatData['status'][$key] ?? null;

                if ($statusAsetId !== null) {
                    // Implementasi proses insert ke tabel riwayat_peminjaman_tanah
                    $newRiwayatPeminjaman = new RiwayatPeminjamanGedung();
                    $newRiwayatPeminjaman->id_peminjaman = $id_peminjaman;
                    $newRiwayatPeminjaman->id_aset_gedung = $aset->id_aset_gedung;
                    $newRiwayatPeminjaman->kode_aset = $aset->kode_aset;
                    $newRiwayatPeminjaman->nama = $aset->nama;
                    $newRiwayatPeminjaman->kondisi = $aset->kondisi;
                    $newRiwayatPeminjaman->bertingkat = $aset->bertingkat;
                    $newRiwayatPeminjaman->beton = $aset->beton;
                    $newRiwayatPeminjaman->luas_lantai = $aset->luas_lantai;
                    $newRiwayatPeminjaman->lokasi = $aset->lokasi;
                    $newRiwayatPeminjaman->tahun_dok = $aset->tahun_dok;
                    $newRiwayatPeminjaman->nomor_dok = $aset->nomor_dok;
                    $newRiwayatPeminjaman->luas = $aset->luas;
                    $newRiwayatPeminjaman->hak = $aset->hak;
                    $newRiwayatPeminjaman->harga = $aset->harga;
                    $newRiwayatPeminjaman->keterangan = $aset->keterangan;

                    // Set atribut tgl_perubahan_status dan kegunaan
                    $newRiwayatPeminjaman->tgl_perubahan_status = $peminjaman->created_at;
                    $newRiwayatPeminjaman->kegunaan = $peminjaman->kegunaan;

                    $newRiwayatPeminjaman->id_status_aset = $statusAsetId; // Ambil status dari form
                    $newRiwayatPeminjaman->status_verifikasi = 'Selesai';
                    $newRiwayatPeminjaman->save();

                    // Lakukan proses perubahan status pada aset_tanah
                    $asetGedung = AsetGedung::find($aset->id_aset_gedung);
                    $asetGedung->id_status_aset = $statusAsetId;
                    $asetGedung->save();
                }
            }

            foreach ($riwayatPeminjamanKendaraan as $key => $aset) {
                $riwayatData = $request->input('riwayatPeminjamanKendaraan');
                $statusAsetId = $riwayatData['status'][$key] ?? null;

                if ($statusAsetId !== null) {
                    // Implementasi proses insert ke tabel riwayat_peminjaman_tanah
                    $newRiwayatPeminjaman = new RiwayatPeminjamanKendaraan();
                    $newRiwayatPeminjaman->id_peminjaman = $id_peminjaman;
                    $newRiwayatPeminjaman->id_aset_kendaraan = $aset->id_aset_kendaraan;
                    $newRiwayatPeminjaman->kode_aset = $aset->kode_aset;
                    $newRiwayatPeminjaman->nama = $aset->nama;
                    $newRiwayatPeminjaman->merk = $aset->merk;
                    $newRiwayatPeminjaman->type = $aset->type;
                    $newRiwayatPeminjaman->cylinder = $aset->cylinder;
                    $newRiwayatPeminjaman->warna = $aset->warna;
                    $newRiwayatPeminjaman->no_rangka = $aset->no_rangka;
                    $newRiwayatPeminjaman->no_mesin = $aset->no_mesin;
                    $newRiwayatPeminjaman->thn_pembuatan = $aset->thn_pembuatan;
                    $newRiwayatPeminjaman->thn_pembelian = $aset->thn_pembelian;
                    $newRiwayatPeminjaman->no_polisi = $aset->no_polisi;
                    $newRiwayatPeminjaman->tgl_bpkb = $aset->tgl_bpkb;
                    $newRiwayatPeminjaman->no_bpkb = $aset->no_bpkb;
                    $newRiwayatPeminjaman->harga = $aset->harga;
                    $newRiwayatPeminjaman->keterangan = $aset->keterangan;

                    // Set atribut tgl_perubahan_status dan kegunaan
                    $newRiwayatPeminjaman->tgl_perubahan_status = $peminjaman->created_at;
                    $newRiwayatPeminjaman->kegunaan = $peminjaman->kegunaan;

                    $newRiwayatPeminjaman->id_status_aset = $statusAsetId; // Ambil status dari form
                    $newRiwayatPeminjaman->status_verifikasi = 'Selesai';
                    $newRiwayatPeminjaman->save();

                    // Lakukan proses perubahan status pada aset_tanah
                    $asetKendaraan = AsetKendaraan::find($aset->id_aset_kendaraan);
                    $asetKendaraan->id_status_aset = $statusAsetId;
                    $asetKendaraan->save();
                }
            }

            foreach ($riwayatPeminjamanInventarisRuangan as $key => $aset) {
                $riwayatData = $request->input('riwayatPeminjamanInventarisRuangan');
                $statusAsetId = $riwayatData['status'][$key] ?? null;

                if ($statusAsetId !== null) {
                    // Implementasi proses insert ke tabel riwayat_peminjaman_tanah
                    $newRiwayatPeminjaman = new RiwayatPeminjamanInventarisRuangan();
                    $newRiwayatPeminjaman->id_peminjaman = $id_peminjaman;
                    $newRiwayatPeminjaman->id_aset_inventaris_ruangan = $aset->id_aset_inventaris_ruangan;
                    $newRiwayatPeminjaman->kode_aset = $aset->kode_aset;
                    $newRiwayatPeminjaman->nama = $aset->nama;
                    $newRiwayatPeminjaman->merk = $aset->merk;
                    $newRiwayatPeminjaman->volume = $aset->volume;
                    $newRiwayatPeminjaman->bahan = $aset->bahan;
                    $newRiwayatPeminjaman->tahun = $aset->tahun;
                    $newRiwayatPeminjaman->harga = $aset->harga;
                    $newRiwayatPeminjaman->keterangan = $aset->keterangan;
                    $newRiwayatPeminjaman->jumlah = $aset->jumlah;

                    // Set atribut tgl_perubahan_status dan kegunaan
                    $newRiwayatPeminjaman->tgl_perubahan_status = $peminjaman->created_at;
                    $newRiwayatPeminjaman->kegunaan = $peminjaman->kegunaan;

                    $newRiwayatPeminjaman->id_status_aset = $statusAsetId; // Ambil status dari form
                    $newRiwayatPeminjaman->status_verifikasi = 'Selesai';
                    $newRiwayatPeminjaman->save();

                    // Lakukan proses perubahan status pada aset_tanah
                    $asetInventarisRuangan = AsetInventarisRuangan::find($aset->id_aset_inventaris_ruangan);
                    $asetInventarisRuangan->id_status_aset = $statusAsetId;
                    $asetInventarisRuangan->save();
                }
            }
            return redirect()->route('riwayatPeminjaman')->with('success', 'Peminjaman Telah Selesai');
        }

        $peminjaman->status_verifikasi = $status;
        $peminjaman->save();

        // Mengupdate status pada riwayat_peminjaman_tanah yang terkait
        $riwayatPeminjamanTanah = RiwayatPeminjamanTanah::where('id_peminjaman', $id_peminjaman)->get();
        $riwayatPeminjamanGedung = RiwayatPeminjamanGedung::where('id_peminjaman', $id_peminjaman)->get();
        $riwayatPeminjamanKendaraan = RiwayatPeminjamanKendaraan::where('id_peminjaman', $id_peminjaman)->get();
        $riwayatPeminjamanInventarisRuangan = RiwayatPeminjamanInventarisRuangan::where('id_peminjaman', $id_peminjaman)->get();
        $status_aset = StatusAset::all();

        foreach ($riwayatPeminjamanTanah as $riwayat) {
            $riwayat->status_verifikasi = $status;
            $riwayat->save();

            // Perbarui status_aset pada tabel riwayat_peminjaman_tanah
            $statusAsetDipinjam = StatusAset::where('status_aset', 'Dipinjam')->first();
            $riwayat->statusAset()->associate($statusAsetDipinjam);
            $riwayat->save();

            // Perbarui status_aset pada tabel aset_tanah
            $asetTanah = $riwayat->asetTanah;
            $statusAsetDipinjam = StatusAset::where('status_aset', 'Dipinjam')->first();

            $asetTanah->id_status_aset = $statusAsetDipinjam->id_status_aset;
            $asetTanah->save();
        }

        foreach ($riwayatPeminjamanGedung as $riwayat) {
            $riwayat->status_verifikasi = $status;
            $riwayat->save();

            // Perbarui status_aset pada tabel riwayat_peminjaman_tanah
            $statusAsetDipinjam = StatusAset::where('status_aset', 'Dipinjam')->first();
            $riwayat->statusAset()->associate($statusAsetDipinjam);
            $riwayat->save();

            // Perbarui status_aset pada tabel aset_tanah
            $asetGedung = $riwayat->asetGedung;
            $statusAsetDipinjam = StatusAset::where('status_aset', 'Dipinjam')->first();

            $asetGedung->id_status_aset = $statusAsetDipinjam->id_status_aset;
            $asetGedung->save();
        }

        foreach ($riwayatPeminjamanKendaraan as $riwayat) {
            $riwayat->status_verifikasi = $status;
            $riwayat->save();

            // Perbarui status_aset pada tabel riwayat_peminjaman_tanah
            $statusAsetDipinjam = StatusAset::where('status_aset', 'Dipinjam')->first();
            $riwayat->statusAset()->associate($statusAsetDipinjam);
            $riwayat->save();

            // Perbarui status_aset pada tabel aset_tanah
            $asetKendaraan = $riwayat->asetKendaraan;
            $statusAsetDipinjam = StatusAset::where('status_aset', 'Dipinjam')->first();

            $asetKendaraan->id_status_aset = $statusAsetDipinjam->id_status_aset;
            $asetKendaraan->save();
        }

        foreach ($riwayatPeminjamanInventarisRuangan as $riwayat) {
            $riwayat->status_verifikasi = $status;
            $riwayat->save();

            // Perbarui status_aset pada tabel riwayat_peminjaman_tanah
            $statusAsetDipinjam = StatusAset::where('status_aset', 'Dipinjam')->first();
            $riwayat->statusAset()->associate($statusAsetDipinjam);
            $riwayat->save();

            // Perbarui status_aset pada tabel aset_tanah
            $asetInventarisRuangan = $riwayat->asetInventarisRuangan;
            $statusAsetDipinjam = StatusAset::where('status_aset', 'Dipinjam')->first();

            $asetInventarisRuangan->id_status_aset = $statusAsetDipinjam->id_status_aset;
            $asetInventarisRuangan->save();
        }

        return redirect()->route('verifikasiPeminjaman')->with('success', 'Peminjaman Telah di ACC');
    }

    public function riwayatPeminjaman()
    {
        $user = auth()->user();

        if ($user) {
            if ($user->hasAnyRole(['Petugas', 'Sekretaris Kwarcab'])) {
                $peminjamanSelesai = Peminjaman::where('status_verifikasi', 'Selesai')->get();
                return view('peminjaman.riwayatPeminjaman', compact('peminjamanSelesai'));
            } else {
                $userID = $user->id;
                $peminjamanSelesai = Peminjaman::where('id_peminjam', $userID)
                    ->whereIn('status_verifikasi', ['Dikirim', 'ACC', 'Selesai'])
                    ->get();

                return view('peminjaman.riwayatPeminjaman', compact('peminjamanSelesai'));
            }
        } else {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat riwayat peminjaman.');
        }
    }

    public function addAset(Request $request)
    {
        // print_r($request->all());
        $jenis_aset = $request->post('jenis');

        if ($jenis_aset == 'tanah') {
            $aset = DB::table('aset_tanah')
                ->leftjoin('status_aset', 'status_aset.id_status_aset', '=', 'aset_tanah.id_status_aset')
                ->whereIn('id_aset_tanah', $request->terpilih)->get();
        } elseif ($jenis_aset == 'gedung') {
            $aset = DB::table('aset_gedung')
                ->leftjoin('status_aset', 'status_aset.id_status_aset', '=', 'aset_gedung.id_status_aset')
                ->whereIn('id_aset_gedung', $request->terpilih)->get();
        } elseif ($jenis_aset == 'kendaraan') {
            $aset = DB::table('aset_kendaraan')
                ->leftjoin('status_aset', 'status_aset.id_status_aset', '=', 'aset_kendaraan.id_status_aset')
                ->whereIn('id_aset_kendaraan', $request->terpilih)->get();
        } elseif ($jenis_aset == 'inventaris_ruangan') {
            $aset = DB::table('aset_inventaris_ruangan')
                ->leftjoin('status_aset', 'status_aset.id_status_aset', '=', 'aset_inventaris_ruangan.id_status_aset')
                ->whereIn('id_aset_inventaris_ruangan', $request->terpilih)->get();
        }
        return response()->json([
            'data' => $aset,
            'jenis_aset' => $jenis_aset,
        ], 200);
    }

    public function getAset(Request $request)
    {
        $jenis_aset = $request->get('jenis');

        if ($jenis_aset == 'tanah') {
            $aset_table = $this->asetTanah();
        } elseif ($jenis_aset == 'gedung') {
            $aset_table = $this->asetGedung();
        } elseif ($jenis_aset == 'kendaraan') {
            $aset_table = $this->asetKendaraan();
        } elseif ($jenis_aset == 'inventaris_ruangan') {
            $aset_table = $this->asetInventarisRuangan();
        }
        return $aset_table;
    }

    private function asetTanah()
    {
        $aset = DB::select('SELECT id_aset_tanah, kode_aset, aset_tanah.nama, letak_tanah, aset_tanah.id_status_aset, status_aset.status_aset FROM aset_tanah
        LEFT JOIN status_aset ON status_aset.id_status_aset = aset_tanah.id_status_aset  WHERE status_aset.status_aset = "Tersedia"');

        $aset_table = '<table class="table mb-0 table-bordered">';
        $aset_table .= '<tr>';
        $aset_table .= '<td>Kode Aset</td>';
        $aset_table .= '<td>Nama Tanah</td>';
        $aset_table .= '<td>Lokasi Tanah</td>';
        $aset_table .= '<td>Status</td>';
        $aset_table .= '<td>Pilih</td>';
        $aset_table .= '</tr>';

        $aset_table .= '';

        foreach ($aset as $row) {
            $aset_table .= '<tr>';
            $aset_table .= '<td>' . $row->kode_aset . '</td>';
            $aset_table .= '<td>' . $row->nama . '</td>';
            $aset_table .= '<td>' . $row->letak_tanah . '</td>';
            $aset_table .= '<td>' . $row->status_aset . '</td>';
            $aset_table .= '<td><input class="form-check-input" name="terpilih[]" type="checkbox" value="' . $row->id_aset_tanah . '"></td>';
            $aset_table .= '</tr>';
        }

        $aset_table .= '</table>';
        return $aset_table;
    }

    private function asetGedung()
    {
        $aset = DB::select('SELECT id_aset_gedung, kode_aset, aset_gedung.nama, lokasi, aset_gedung.id_status_aset, status_aset.status_aset FROM aset_gedung
        LEFT JOIN status_aset ON status_aset.id_status_aset = aset_gedung.id_status_aset WHERE status_aset.status_aset = "Tersedia"');

        $aset_table = '<table class="table mb-0 table-bordered">';
        $aset_table .= '<tr>';
        $aset_table .= '<td>Kode Aset</td>';
        $aset_table .= '<td>Nama Gedung</td>';
        $aset_table .= '<td>Lokasi Gedung</td>';
        $aset_table .= '<td>Status</td>';
        $aset_table .= '<td>Pilih</td>';
        $aset_table .= '</tr>';

        $aset_table .= '';

        foreach ($aset as $row) {
            $aset_table .= '<tr>';
            $aset_table .= '<td>' . $row->kode_aset . '</td>';
            $aset_table .= '<td>' . $row->nama . '</td>';
            $aset_table .= '<td>' . $row->lokasi . '</td>';
            $aset_table .= '<td>' . $row->status_aset . '</td>';
            $aset_table .= '<td><input class="form-check-input" name="terpilih[]" type="checkbox" value="' . $row->id_aset_gedung . '"></td>';
            $aset_table .= '</tr>';
        }

        $aset_table .= '</table>';
        return $aset_table;
    }

    private function asetKendaraan()
    {
        $aset = DB::select('SELECT id_aset_kendaraan, kode_aset, aset_kendaraan.nama, merk, warna, no_polisi, aset_kendaraan.id_status_aset, status_aset.status_aset FROM aset_kendaraan
        LEFT JOIN status_aset ON status_aset.id_status_aset = aset_kendaraan.id_status_aset WHERE status_aset.status_aset = "Tersedia"');

        $aset_table = '<table class="table mb-0 table-bordered">';
        $aset_table .= '<tr>';
        $aset_table .= '<td>Kode Aset</td>';
        $aset_table .= '<td>Nama Kendaraan</td>';
        $aset_table .= '<td>Merk</td>';
        $aset_table .= '<td>Warna</td>';
        $aset_table .= '<td>No Polisi</td>';
        $aset_table .= '<td>Status</td>';
        $aset_table .= '<td>Pilih</td>';
        $aset_table .= '</tr>';
        $aset_table .= '';

        foreach ($aset as $row) {
            $aset_table .= '<tr>';
            $aset_table .= '<td>' . $row->kode_aset . '</td>';
            $aset_table .= '<td>' . $row->nama . '</td>';
            $aset_table .= '<td>' . $row->merk . '</td>';
            $aset_table .= '<td>' . $row->warna . '</td>';
            $aset_table .= '<td>' . $row->no_polisi . '</td>';
            $aset_table .= '<td>' . $row->status_aset . '</td>';
            $aset_table .= '<td><input class="form-check-input" name="terpilih[]" type="checkbox" value="' . $row->id_aset_kendaraan . '"></td>';
            $aset_table .= '</tr>';
        }

        $aset_table .= '</table>';
        return $aset_table;
    }

    private function asetInventarisRuangan()
    {
        $aset = DB::select('SELECT id_aset_inventaris_ruangan, kode_aset, aset_inventaris_ruangan.nama, merk, bahan, jumlah, aset_inventaris_ruangan.id_status_aset, status_aset.status_aset FROM aset_inventaris_ruangan LEFT JOIN status_aset ON status_aset.id_status_aset = aset_inventaris_ruangan.id_status_aset WHERE status_aset.status_aset = "Tersedia";');

        $aset_table = '<table class="table mb-0 table-bordered">';
        $aset_table .= '<tr>';
        $aset_table .= '<td>Kode Aset</td>';
        $aset_table .= '<td>Nama Inventaris Ruangan</td>';
        $aset_table .= '<td>Merk</td>';
        $aset_table .= '<td>Bahan</td>';
        $aset_table .= '<td>Jumlah</td>';
        $aset_table .= '<td>Status</td>';
        $aset_table .= '<td>Pilih</td>';
        $aset_table .= '</tr>';
        $aset_table .= '';

        foreach ($aset as $row) {
            $aset_table .= '<tr>';
            $aset_table .= '<td>' . $row->kode_aset . '</td>';
            $aset_table .= '<td>' . $row->nama . '</td>';
            $aset_table .= '<td>' . $row->merk . '</td>';
            $aset_table .= '<td>' . $row->bahan . '</td>';
            $aset_table .= '<td>' . $row->jumlah . '</td>';
            $aset_table .= '<td>' . $row->status_aset . '</td>';
            $aset_table .= '<td><input class="form-check-input" name="terpilih[]" type="checkbox" value="' . $row->id_aset_inventaris_ruangan . '"></td>';
            $aset_table .= '</tr>';
        }

        $aset_table .= '</table>';
        return $aset_table;
    }

    // public function show(Peminjaman $peminjaman)
    // {

    // }

    // public function edit(Peminjaman $peminjaman)
    // {

    // }

    // public function update(Request $request, Peminjaman $peminjaman)
    // {

    // }

    // public function destroy(Peminjaman $peminjaman)
    // {

    // }
}
