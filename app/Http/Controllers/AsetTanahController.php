<?php

namespace App\Http\Controllers;

use App\Exports\AsetTanahExport;
use App\Http\Requests\AsetTanahImportRequest;
use App\Http\Requests\StoreAsetTanahRequest;
use App\Http\Requests\UpdateAsetTanahRequest;
use App\Imports\AsetTanahImport;
use App\Models\AsetTanah;
use App\Models\RiwayatPeminjamanTanah;
use App\Models\StatusAset;
use Illuminate\Support\Facades\DB;

class AsetTanahController extends Controller
{
    public function index()
    {
        $asetTanahs = AsetTanah::with('statusAset')->get();
        return view('aset.tanah.index', ['asetTanahs' => $asetTanahs]);
    }

    public function create()
    {
        $status_aset = StatusAset::all();
        $kode_tanah = $this->generateUniqueKode();

        return view('aset.tanah.create', compact('status_aset', 'kode_tanah'));
    }

    private function generateUniqueKode()
    {
        $prefix_kabupaten = '02'; // Kode untuk kabupaten
        $prefix_tanah = '01'; // Kode untuk aset tanah

        // Ambil nilai terakhir yang digunakan
        $last_used_number = AsetTanah::where('kode_aset', 'like', $prefix_kabupaten . '.' . $prefix_tanah . '.%')
            ->max(DB::raw('SUBSTRING(kode_aset, -4)'));

        // Jika tidak ada nilai terakhir, atur ke 0
        $last_used_number = $last_used_number ? (int) $last_used_number : 0;

        // Iterasi ke angka berikutnya
        $next_number = $last_used_number + 1;

        // Format angka menjadi 4 digit dengan padding
        $next_number_padded = str_pad($next_number, 4, '0', STR_PAD_LEFT);

        // Generate kode tanah dengan menggabungkan semua elemen
        $kode_tanah = $prefix_kabupaten . '.' . $prefix_tanah . '.' . $next_number_padded;

        return $kode_tanah;
    }

    public function store(StoreAsetTanahRequest $request)
    {
        // Validasi telah dihandle oleh middleware
        $validated = $request->validated();
        // echo '<pre>';
        // print_r($validated);
        // die;
        try {
            // Simpan data ke dalam tabel aset_tanah
            $asetTanah = new AsetTanah();
            $asetTanah->id_status_aset = $validated['id_status_aset'];
            $asetTanah->kode_aset = $validated['kode_aset'];
            $asetTanah->nama = $validated['nama'];
            $asetTanah->tanggal_inventarisir = $validated['tanggal_inventarisir'];
            $asetTanah->luas = $validated['luas'];
            $asetTanah->letak_tanah = $validated['letak_tanah'];
            $asetTanah->hak = $validated['hak'];
            $asetTanah->tanggal_sertifikat = $validated['tanggal_sertifikat'];
            $asetTanah->no_sertifikat = $validated['no_sertifikat'];
            $asetTanah->penggunaan = $validated['penggunaan'];
            $asetTanah->harga = $validated['harga'];
            $asetTanah->keterangan = $validated['keterangan'];

            // Simpan ke dalam database
            $asetTanah->save();

            return redirect()->route('tanah.index')
                ->with('success', 'Data aset tanah berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data aset tanah.');
        }
    }

    public function edit(AsetTanah $asetTanah, $id_aset_tanah)
    {
        $aset_tanah = AsetTanah::find($id_aset_tanah);
        $status_aset = StatusAset::all();
        return view('aset.tanah.edit', compact('aset_tanah', 'status_aset'));
    }

    public function update(UpdateAsetTanahRequest $request)
    {
        $validated = $request->validated();
        // echo '<pre>';
        // print_r($asetTanah->id_aset_tanah);
        // die;

        // insert data ke db
        AsetTanah::where('id_aset_tanah', $request->id_aset_tanah)
            ->update($validated);
        return redirect()->route('tanah.index')
            ->with('success', 'Aset Tanah berhasil diperbarui.');
    }

    public function destroy($id_aset_tanah)
    {
        // Cek apakah aset pernah dipinjam
        $isAsetDipinjam = RiwayatPeminjamanTanah::where('id_aset_tanah', $id_aset_tanah)->exists();

        if ($isAsetDipinjam) {
            return redirect()->route('tanah.index')
                ->with('error', 'Data aset inventaris sudah pernah dipinjam, tidak dapat dihapus.');
        }

        AsetTanah::find($id_aset_tanah)->delete();
        return redirect()->route('tanah.index')
            ->with('success', 'Aset Tanah berhasil dihapus.');
    }

    public function import(AsetTanahImportRequest $request)
    {
        $file = $request->file('file');

        try {
            DB::beginTransaction();

            // Validasi file
            $file->store('public/import');

            // Lakukan impor
            $import = new AsetTanahImport;
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
            return redirect()->route('tanah.index')
                ->with('success', "Data berhasil diimpor. Total aset yang berhasil di import: $importedRowCount");

        } catch (\Exception $e) {
            // Tangani exception jika terjadi kesalahans
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function export()
    {
        return (new AsetTanahExport)->download('aset_tanah.xlsx');
    }

}
