<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Models\AsetGedung;
use App\Models\StatusAset;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\AsetGedungExport;
use App\Imports\AsetGedungImport;
use Illuminate\Support\Facades\DB;
use App\Models\RiwayatPeminjamanGedung;
use App\Http\Requests\StoreAsetGedungRequest;
use App\Http\Requests\AsetGedungImportRequest;
use App\Http\Requests\UpdateAsetGedungRequest;
use App\Http\Requests\ExportPdfAsetGedungRequest;

class AsetGedungController extends Controller
{
    public function index()
    {
        $asetGedungs = AsetGedung::with('statusAset')->get();
        $statusAset = StatusAset::all();

        if (request()->ajax()) {
            return Datatables::of($asetGedungs)
                ->addIndexColumn()
                ->addColumn('status_aset', function ($asetGedung) {
                    return $asetGedung->statusAset->status_aset;
                })
                ->addColumn('tanggal_inventarisir', function ($asetGedung) {
                    return \Carbon\Carbon::parse($asetGedung->tanggal_inventarisir)->isoFormat('D MMMM Y');
                })
                ->addColumn('harga', function ($asetGedung) {
                    return formatRupiah($asetGedung->harga, true);
                })
                ->addColumn('action', function ($asetGedung) {
                    return view('aset.gedung.actions', compact('asetGedung'))->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('aset.gedung.index', compact('asetGedungs', 'statusAset'));
    }

    public function showDetail(Request $request)
    {
        $id = $request->input('id');
        $asetGedung = AsetGedung::with('statusAset')->findOrFail($id);

        return response()->json([
            'status_aset' => $asetGedung->statusAset->status_aset,
            'kode_aset' => $asetGedung->kode_aset,
            'tanggal_inventarisir' => Carbon::parse($asetGedung->tanggal_inventarisir)->isoFormat('D MMMM Y'),
            'nama' => $asetGedung->nama,
            'kondisi' => $asetGedung->kondisi,
            'bertingkat' => $asetGedung->bertingkat,
            'beton' => $asetGedung->beton,
            'luas_lantai' => $asetGedung->luas_lantai,
            'lokasi' => $asetGedung->lokasi,
            'tahun_dok' => $asetGedung->tahun_dok,
            'nomor_dok' => $asetGedung->nomor_dok,
            'luas' => $asetGedung->luas,
            'hak' => $asetGedung->hak,
            'harga' => formatRupiah($asetGedung->harga, true),
            'keterangan' => $asetGedung->keterangan,
        ]);
    }

    public function create()
    {
        $status_aset = StatusAset::all();
        $kode_gedung = $this->generateUniqueKode();
        return view('aset.gedung.create', compact('status_aset', 'kode_gedung'));
    }

    private function generateUniqueKode()
    {
        $prefix_kabupaten = '02'; // Kode untuk kabupaten
        $prefix_gedung = '02'; // Kode untuk aset tanah

        // Ambil nilai terakhir yang digunakan
        $last_used_number = AsetGedung::where('kode_aset', 'like', $prefix_kabupaten . '.' . $prefix_gedung . '.%')
            ->max(DB::raw('SUBSTRING(kode_aset, -4)'));

        // Jika tidak ada nilai terakhir, atur ke 0
        $last_used_number = $last_used_number ? (int) $last_used_number : 0;

        // Iterasi ke angka berikutnya
        $next_number = $last_used_number + 1;

        // Format angka menjadi 4 digit dengan padding
        $next_number_padded = str_pad($next_number, 4, '0', STR_PAD_LEFT);

        // Generate kode tanah dengan menggabungkan semua elemen
        $kode_gedung = $prefix_kabupaten . '.' . $prefix_gedung . '.' . $next_number_padded;

        return $kode_gedung;
    }

    public function store(StoreAsetGedungRequest $request)
    {

        $validated = $request->validated();
        // echo '<pre>';
        // print_r($validated);
        // die;
        try {
            // Simpan data ke dalam tabel aset_gedung
            $asetGedung = new AsetGedung();
            $asetGedung->id_status_aset = $validated['id_status_aset'];
            $asetGedung->kode_aset = $validated['kode_aset'];
            $asetGedung->nama = $validated['nama'];
            $asetGedung->tanggal_inventarisir = $validated['tanggal_inventarisir'];
            $asetGedung->kondisi = $validated['kondisi'];
            $asetGedung->bertingkat = $validated['bertingkat'];
            $asetGedung->beton = $validated['beton'];
            $asetGedung->luas_lantai = $validated['luas_lantai'];
            $asetGedung->lokasi = $validated['lokasi'];
            $asetGedung->tahun_dok = $validated['tahun_dok'];
            $asetGedung->nomor_dok = $validated['nomor_dok'];
            $asetGedung->luas = $validated['luas'];
            $asetGedung->hak = $validated['hak'];
            $asetGedung->harga = $validated['harga'];
            $asetGedung->keterangan = $validated['keterangan'];

            // Simpan ke dalam database
            $asetGedung->save();

            return redirect()->route('gedung.index')
                ->with('success', 'Data aset gedung berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data aset gedung.');
        }
    }

    public function edit(AsetGedung $asetGedung, $id_aset_gedung)
    {
        $id = decrypt($id_aset_gedung);
        $aset_gedung = AsetGedung::find($id);
        $status_aset = StatusAset::all();
        return view('aset.gedung.edit', compact('aset_gedung', 'status_aset'));
    }

    public function update(UpdateAsetGedungRequest $request)
    {
        $validated = $request->validated();

        // insert data ke db
        AsetGedung::where('id_aset_gedung', $request->id_aset_gedung)
            ->update($validated);
        return redirect()->route('gedung.index')->with('success', 'Aset Gedung berhasil diperbarui.');
    }

    public function destroy($id_aset_gedung)
    {
        // Cek apakah aset pernah dipinjam
        $isAsetDipinjam = RiwayatPeminjamanGedung::where('id_aset_gedung', $id_aset_gedung)->exists();

        if ($isAsetDipinjam) {
            return redirect()->route('gedung.index')
                ->with('error', 'Data aset inventaris sudah pernah dipinjam, tidak dapat dihapus.');
        }

        AsetGedung::find($id_aset_gedung)->delete();
        return redirect()->route('gedung.index');
    }

    public function importExcel(AsetGedungImportRequest $request)
    {
        $file = $request->file('file');

        try {
            DB::beginTransaction();

            $file->store('public/import');

            $import = new AsetGedungImport;
            $import->import($file);

            if ($import->failures()->isNotEmpty()) {
                $import->customValidation($import->failures());
                DB::rollBack();
                return back()
                    ->withFailures($import->failures())
                    ->with('error', 'Gagal mengimpor data. Silakan periksa file Anda.');
            }

            if ($import->failures()->isNotEmpty()) {
                DB::rollBack();

                return back()
                    ->withFailures($import->failures())
                    ->with('error', 'Gagal mengimpor data. Silakan periksa file Anda.');
            }
            $importedRowCount = $import->getRowCount();

            DB::commit();

            return redirect()->route('gedung.index')
                ->with('success', "Data berhasil diimpor. Total aset yang berhasil di import: $importedRowCount");

        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Terjadi kesalahan: ' . $e->getMessage())->persistent(true, false);
            return back();
        }
    }

    public function exportExcel()
    {
        return (new AsetGedungExport)->download('aset_gedung.xlsx');
    }

    public function exportPdf(ExportPdfAsetGedungRequest $request)
    {
        $query = AsetGedung::with('statusAset')->orderBy('id_aset_gedung');

        if ($request->opsi === 'Berdasarkan Status Aset') {
            $status_aset = $request->status_aset;
            $query->where('id_status_aset', $status_aset);

        } elseif ($request->opsi === 'Berdasarkan Hak') {
            $hak = $request->hak;
            $query->where('hak', $hak);

        } elseif ($request->opsi === 'Berdasarkan Kondisi') {
            $kondisi = $request->kondisi;
            $query->where('kondisi', $kondisi);

        } elseif ($request->opsi === 'Berdasarkan Tahun Dokumen') {
            $tahun_dok = $request->tahun_dok;
            $query->where('tahun_dok', $tahun_dok);

        } elseif ($request->opsi === 'Berdasarkan Kustom') {

            if ($request->filled('status_aset2')) {
                $status_aset2 = $request->status_aset2;
                $query->where('id_status_aset', $status_aset2);
            }

            if ($request->filled('kondisi2')) {
                $kondisi2 = $request->kondisi2;
                $query->where('kondisi', $kondisi2);
            }

            if ($request->filled('hak2')) {
                $hak2 = $request->hak2;
                $query->where('hak', $hak2);
            }

            if ($request->filled('tahun_dok2')) {
                $tahun_dok2 = $request->tahun_dok2;
                $query->where('tahun_dok', $tahun_dok2);
            }
        }

        $aset_gedung = $query->get();

        if ($aset_gedung->isEmpty()) {
            return redirect()->back()->with('error', 'Data yang dicari tidak ditemukan.');
        }

        $pdf = PDF::loadview('aset.gedung.cetak_pdf', [
            'aset_gedung' => $aset_gedung,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('aset_gedung.pdf');
    }
}