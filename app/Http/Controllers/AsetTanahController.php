<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Models\AsetTanah;
use App\Models\StatusAset;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\AsetTanahExport;
use App\Imports\AsetTanahImport;
use Illuminate\Support\Facades\DB;
use App\Models\RiwayatPeminjamanTanah;
use App\Http\Requests\StoreAsetTanahRequest;
use App\Http\Requests\AsetTanahImportRequest;
use App\Http\Requests\UpdateAsetTanahRequest;
use App\Http\Requests\ExportPdfAsetTanahRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AsetTanahController extends Controller
{
    public function index()
    {
        $asetTanahs = AsetTanah::with('statusAset')->get();
        $statusAset = StatusAset::all();

        if (request()->ajax()) {
            return Datatables::of($asetTanahs)
                ->addIndexColumn()
                ->addColumn('status_aset', function ($asetTanah) {
                    return $asetTanah->statusAset->status_aset;
                })
                ->addColumn('tanggal_inventarisir', function ($asetTanah) {
                    return \Carbon\Carbon::parse($asetTanah->tanggal_inventarisir)->isoFormat('D MMMM Y');
                })
                ->addColumn('tanggal_sertifikat', function ($asetTanah) {
                    return \Carbon\Carbon::parse($asetTanah->tanggal_sertifikat)->isoFormat('D MMMM Y');
                })
                ->addColumn('harga', function ($asetTanah) {
                    return formatRupiah($asetTanah->harga, true);
                })
                ->addColumn('action', function ($asetTanah) {
                    return view('aset.tanah.actions', compact('asetTanah'))->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('aset.tanah.index', compact('asetTanahs', 'statusAset'));
    }

    public function showDetail(Request $request)
    {
        $id = $request->input('id');
        $asetTanah = AsetTanah::with('statusAset')->findOrFail($id);

        return response()->json([
            'id_aset_tanah' => $asetTanah->id_aset_tanah,
            'kode_aset' => $asetTanah->kode_aset,
            'status_aset' => $asetTanah->statusAset->status_aset,
            'tanggal_inventarisir' => Carbon::parse($asetTanah->tanggal_inventarisir)->isoFormat('D MMMM Y'),
            'nama' => $asetTanah->nama,
            'luas' => $asetTanah->luas,
            'letak_tanah' => $asetTanah->letak_tanah,
            'hak' => $asetTanah->hak,
            'tanggal_sertifikat' => $asetTanah->tanggal_sertifikat,
            'no_sertifikat' => $asetTanah->no_sertifikat,
            'penggunaan' => $asetTanah->penggunaan,
            'harga' => formatRupiah($asetTanah->harga, true),
            'keterangan' => $asetTanah->keterangan,
        ]);
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
            ->max(DB::raw('CAST(SUBSTRING(kode_aset, -4) AS SIGNED)'));

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
                ->with('success', 'Data Aset Tanah berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data aset tanah.');
        }
    }

    public function edit(AsetTanah $asetTanah, $id_aset_tanah)
    {
        $id = decrypt($id_aset_tanah);
        $aset_tanah = AsetTanah::find($id);
        $status_aset = StatusAset::all();
        return view('aset.tanah.edit', compact('aset_tanah', 'status_aset'));
    }

    public function update(UpdateAsetTanahRequest $request)
    {
        $validated = $request->validated();
        // insert data ke db
        AsetTanah::where('id_aset_tanah', $request->id_aset_tanah)
            ->update($validated);
        return redirect()->route('tanah.index')
            ->with('success', 'Data Aset Tanah berhasil diperbarui.');
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
        return redirect()->route('tanah.index');
    }

    public function importExcel(AsetTanahImportRequest $request)
    {
        try {
            DB::beginTransaction();

            // Validasi file
            $file = $request->file('file');

            // Lakukan impor
            $import = new AsetTanahImport;
            $import->import($file);

            if ($import->failures()->isNotEmpty()) {
                $import->customValidation($import->failures());
                DB::rollBack();
                return back()
                    ->withFailures($import->failures())
                    ->with('error', 'Gagal mengimpor data. Silakan periksa file Anda.');
            }

            // Periksa kegagalan impor
            if ($import->failures()->isNotEmpty()) {
                // Batalkan transaksi jika ada kegagalan
                DB::rollBack();

                return back()
                    ->withFailures($import->failures())
                    ->with('error', 'Gagal mengimpor data. Silakan periksa file Anda.');
            }
            // Mendapatkan jumlah baris yang berhasil diimpor
            $importedRowCount = $import->getRowCount();

            // Hapus file setelah berhasil mengimpor
            Storage::delete($file->path());

            // Commit transaksi jika sukses
            DB::commit();
            return redirect()->route('tanah.index')
                ->with('success', "Data berhasil diimpor. Total aset yang berhasil di import: $importedRowCount");

        } catch (\Exception $e) {
            // Tangani exception jika terjadi kesalahan
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function exportExcel()
    {
        return (new AsetTanahExport)->download('aset_tanah.xlsx');
    }

    public function exportPdf(ExportPdfAsetTanahRequest $request)
    {
        $query = AsetTanah::with('statusAset')->orderBy('id_aset_tanah');

        if ($request->opsi === 'Berdasarkan Status Aset') {
            $status_aset = $request->status_aset;

            $query->where('id_status_aset', $status_aset);

        } elseif ($request->opsi === 'Berdasarkan Hak') {
            $hak = $request->hak;

            $query->where('hak', $hak);

        } elseif ($request->opsi === 'Berdasarkan Kustom') {

            if ($request->filled('status_aset2')) {
                $status_aset2 = $request->status_aset2;
                $query->where('id_status_aset', $status_aset2);
            }

            if ($request->filled('hak2')) {
                $hak2 = $request->hak2;
                $query->where('hak', $hak2);
            }
        }

        $aset_tanah = $query->get();

        if ($aset_tanah->isEmpty()) {
            return redirect()->back()->with('error', 'Data yang dicari tidak ditemukan.');
        }

        $pdf = PDF::loadview('aset.tanah.cetak_pdf', [
            'aset_tanah' => $aset_tanah,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('aset_tanah.pdf');
    }
}
