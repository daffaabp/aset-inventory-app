<?php

namespace App\Http\Controllers;

use App\Exports\AsetInventarisExport;
use App\Http\Requests\AsetInventarisImportRequest;
use App\Http\Requests\ExportPdfRequest;
use App\Http\Requests\StoreAsetInventarisRuanganRequest;
use App\Http\Requests\StoreMassalAsetInventarisRuanganRequest;
use App\Http\Requests\UpdateAsetInventarisRuanganRequest;
use App\Imports\AsetInventarisImport;
use App\Models\AsetInventarisRuangan;
use App\Models\RiwayatPeminjamanInventarisRuangan;
use App\Models\Ruangan;
use App\Models\StatusAset;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class AsetInventarisRuanganController extends Controller
{

    public function index()
    {
        $asetInventaris = AsetInventarisRuangan::with(['statusAset', 'ruangan'])->get();
        // Ambil daftar ruangan dari model Ruangan atau sumber data lainnya
        $daftarRuangan = Ruangan::all(); // Gantilah sesuai model atau sumber data yang sesuai

        return view('aset.inventaris.index', compact('asetInventaris', 'daftarRuangan'));
    }

    public function indexMassal()
    {
        $asetInventaris = AsetInventarisRuangan::select('aset_inventaris_ruangan.grup_id', 'aset_inventaris_ruangan.nama', 'aset_inventaris_ruangan.merk', 'ruangan.nama as nama_ruangan', DB::raw('SUM(aset_inventaris_ruangan.jumlah) as total_jumlah'))
            ->join('ruangan', 'aset_inventaris_ruangan.kode_ruangan', '=', 'ruangan.kode_ruangan')
            ->groupBy('aset_inventaris_ruangan.grup_id', 'aset_inventaris_ruangan.nama', 'aset_inventaris_ruangan.merk', 'ruangan.nama')
            ->whereNotNull('aset_inventaris_ruangan.grup_id') // Hanya aset dengan grup_id yang tidak null
            ->whereNotIn('aset_inventaris_ruangan.grup_id', function ($subquery) {
                $subquery->select('grup_id')
                    ->from('riwayat_peminjaman_inventaris_ruangan')
                    ->whereColumn('riwayat_peminjaman_inventaris_ruangan.grup_id', 'aset_inventaris_ruangan.grup_id')
                    ->where('status_verifikasi', ['ACC', 'Ditolak', 'Dikirim']);
            })
            ->get();

        return view('aset.inventaris.indexMassal', compact('asetInventaris'));
    }

    public function create()
    {
        $status_aset = StatusAset::all();
        $ruangan = Ruangan::all();
        return view('aset.inventaris.create', compact('status_aset', 'ruangan'));
    }

    public function createMassal()
    {
        $status_aset = StatusAset::all();
        $ruangan = Ruangan::all();
        return view('aset.inventaris.createMassal', compact('status_aset', 'ruangan'));
    }

    public function store(StoreAsetInventarisRuanganRequest $request)
    {
        // Validasi telah dihandle oleh middleware
        $validated = $request->validated();

        try {
            $kodeRuangan = $validated['kode_ruangan'];

            // Ambil kode terakhir dari database
            $lastAset = AsetInventarisRuangan::where('kode_aset', 'like', '02.04.' . $kodeRuangan . '.%')
                ->orderBy('kode_aset', 'desc')
                ->first();

            // Jika ada kode terakhir, tambahkan satu untuk mendapatkan urutan berikutnya
            // Jika tidak, mulai dari 0001
            if ($lastAset) {
                $lastNumber = substr($lastAset->kode_aset, -4);
                $nextNumber = str_pad((int) $lastNumber + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $nextNumber = '0001';
            }

            // Gabungkan semua komponen untuk membuat kode aset yang baru
            $newKodeAset = '02.04.' . $kodeRuangan . '.' . $nextNumber;

            // Simpan data ke dalam tabel aset_gedung
            $asetInventaris = new AsetInventarisRuangan();
            $asetInventaris->id_status_aset = $validated['id_status_aset'];
            $asetInventaris->kode_ruangan = $validated['kode_ruangan'];
            $asetInventaris->kode_aset = $newKodeAset;
            $asetInventaris->grup_id = $validated['grup_id'];
            $asetInventaris->nama = $validated['nama'];
            $asetInventaris->tanggal_inventarisir = $validated['tanggal_inventarisir'];
            $asetInventaris->merk = $validated['merk'];
            $asetInventaris->volume = $validated['volume'];
            $asetInventaris->bahan = $validated['bahan'];
            $asetInventaris->tahun = $validated['tahun'];
            $asetInventaris->harga = $validated['harga'];
            $asetInventaris->keterangan = $validated['keterangan'];
            $asetInventaris->jumlah = $validated['jumlah'];

            // Simpan ke dalam database
            $asetInventaris->save();

            return redirect()->route('inventaris.index')
                ->with('success', 'Data aset inventaris berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data aset inventaris.');
        }
    }

    public function storeMassal(StoreMassalAsetInventarisRuanganRequest $request)
    {
        // Validasi telah dihandle oleh middleware
        $validated = $request->validated();

        try {

            $kodeRuangan = $validated['kode_ruangan'];

            // Lakukan pengecekan kode aset yang terakhir
            $lastAset = AsetInventarisRuangan::where('kode_aset', 'like', '02.04.' . $kodeRuangan . '.%')
                ->orderBy('kode_aset', 'desc')
                ->first();

            // Ambil kode terakhir jika ada, atau mulai dari 0001 jika tidak
            $nextNumber = $lastAset ? (int) substr($lastAset->kode_aset, -4) + 1 : 1;

            $newAsets = []; // Untuk menyimpan data aset yang akan dibuat

            // Loop sesuai jumlah aset yang ingin ditambahkan
            for ($i = 0; $i < $validated['jumlah']; $i++) {
                // Format nomor urutan dengan padding nol di depan
                $formattedNumber = str_pad($nextNumber + $i, 4, '0', STR_PAD_LEFT);

                // Gabungkan semua komponen untuk membuat kode aset yang baru
                $newKodeAset = '02.04.' . $kodeRuangan . '.' . $formattedNumber;

                // Simpan data aset ke dalam array
                $newAsets[] = [
                    'id_status_aset' => $validated['id_status_aset'],
                    'kode_ruangan' => $validated['kode_ruangan'],
                    'kode_aset' => $newKodeAset,
                    'grup_id' => $validated['grup_id'],
                    'nama' => $validated['nama'],
                    'tanggal_inventarisir' => $validated['tanggal_inventarisir'],
                    'merk' => $validated['merk'],
                    'volume' => $validated['volume'],
                    'bahan' => $validated['bahan'],
                    'tahun' => $validated['tahun'],
                    'harga' => $validated['harga'],
                    'keterangan' => $validated['keterangan'],
                    'jumlah' => 1, // Set jumlah ke 1 untuk setiap aset
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Simpan semua data aset baru ke dalam database
            AsetInventarisRuangan::insert($newAsets);

            return redirect()->route('inventaris.index')
                ->with('success', 'Data aset inventaris berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data aset inventaris.');
        }
    }

    public function edit(AsetInventarisRuangan $asetInventarisRuangan, $id_aset_inventaris_ruangan)
    {
        $asetInventaris = AsetInventarisRuangan::find($id_aset_inventaris_ruangan);
        $status_aset = StatusAset::all();
        $kode_ruangan = Ruangan::all();
        return view('aset.inventaris.edit', compact('asetInventaris', 'status_aset', 'kode_ruangan'));
    }

    public function update(UpdateAsetInventarisRuanganRequest $request)
    {
        $validated = $request->validated();

        // insert data ke db
        AsetInventarisRuangan::where('id_aset_inventaris_ruangan', $request->id_aset_inventaris_ruangan)
            ->update($validated);
        return redirect()->route('inventaris.index')->with('success', 'Aset Inventaris berhasil diperbarui.');
    }

    public function destroy($id_aset_inventaris_ruangan)
    {
        // Cek apakah aset pernah dipinjam
        $isAsetDipinjam = RiwayatPeminjamanInventarisRuangan::where('id_aset_inventaris_ruangan', $id_aset_inventaris_ruangan)->exists();

        if ($isAsetDipinjam) {
            return redirect()->route('inventaris.index')
                ->with('error', 'Data aset inventaris sudah pernah dipinjam, tidak dapat dihapus.');
        }

        AsetInventarisRuangan::find($id_aset_inventaris_ruangan)->delete();
        return redirect()->route('inventaris.index')
            ->with('success', 'Aset Gedung berhasil dihapus.');
    }

    public function destroyMassal($grupId)
    {
        AsetInventarisRuangan::where('grup_id', $grupId)->delete();

        return redirect()->route('inventaris.indexMassal')
            ->with('success', 'Data aset inventaris berhasil dihapus.');
    }

    public function importExcel(AsetInventarisImportRequest $request)
    {
        $file = $request->file('file');

        try {
            DB::beginTransaction();

            // Validasi file
            $file->store('public/import');

            // Lakukan impor
            $import = new AsetInventarisImport;
            $import->import($file);

            // Periksa kegagalan impor
            if ($import->failures()->isNotEmpty()) {
                // Batalkan transaksi jika ada kegagalan
                DB::rollBack();

                // Berikan umpan balik ke pengguna tentang kegagalan
                return back()
                    ->withFailures($import->failures())
                    ->with('error', 'Gagal mengimpor data. Silakan periksa file Anda.');
            }
            // Mendapatkan jumlah baris yang berhasil diimpor
            $importedRowCount = $import->getRowCount();

            // Commit transaksi jika sukses
            DB::commit();

            // Berikan umpan balik sukses ke pengguna
            return redirect()->route('inventaris.index')
                ->with('success', "Data berhasil diimpor. Total aset yang berhasil di import: $importedRowCount");

        } catch (\Exception $e) {
            // Tangani exception jika terjadi kesalahans
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function exportExcel()
    {
        return (new AsetInventarisExport)->download('aset_inventaris_ruangan.xlsx');
    }

    public function exportPdf(ExportPdfRequest $request)
    {
        $query = AsetInventarisRuangan::with(['statusAset', 'ruangan'])
            ->orderBy('grup_id'); // Urutkan berdasarkan grup_id agar yang sama berada bersamaan

        // Lakukan pengecekan opsi yang dipilih
        if ($request->opsi === 'Berdasarkan Ruang') {
            $ruangan_id = $request->ruangan_id;

            $query->where('kode_ruangan', $ruangan_id);
            if ($request->filled('tahun_perolehan2')) {
                $tahun_perolehan2 = $request->tahun_perolehan2;
                $query->where('tahun', $tahun_perolehan2);
            }
        } elseif ($request->opsi === 'Data Tahun Ini') {
            $query->where('tahun', now()->year);
        } elseif ($request->opsi === 'Berdasarkan Tahun Perolehan') {
            $tahun_perolehan = $request->tahun_perolehan;
            $query->where('tahun', $tahun_perolehan);
        }

        $aset_inventaris = $query->get();

        // Periksa jika tidak ada hasil
        if ($aset_inventaris->isEmpty()) {
            return redirect()->back()->with('error', 'Data yang dicari tidak ditemukan.');
        }

        // Gunakan koleksi untuk menyusun ulang data dengan logika yang diinginkan
        $groupedAsets = $aset_inventaris->groupBy('grup_id');

        $pdf = PDF::loadview('aset.inventaris.cetak_pdf', [
            'groupedAsets' => $groupedAsets,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('aset_inventaris_ruangan.pdf');
    }

}
