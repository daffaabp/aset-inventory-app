<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Models\StatusAset;
use Illuminate\Http\Request;
use App\Models\AsetKendaraan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Exports\AsetKendaraanExport;
use App\Imports\AsetKendaraanImport;
use App\Models\RiwayatPeminjamanKendaraan;
use App\Http\Requests\StoreAsetKendaraanRequest;
use App\Http\Requests\AsetKendaraanImportRequest;
use App\Http\Requests\UpdateAsetKendaraanRequest;

class AsetKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asetKendaraans = AsetKendaraan::with('statusAset')->get();
        $statusAset = StatusAset::all();

        if (request()->ajax()) {
            return Datatables::of($asetKendaraans)
                ->addIndexColumn()
                ->addColumn('status_aset', function ($asetKendaraan) {
                    return $asetKendaraan->statusAset->status_aset;
                })
                ->addColumn('tanggal_inventarisir', function ($asetKendaraan) {
                    return \Carbon\Carbon::parse($asetKendaraan->tanggal_inventarisir)->isoFormat('D MMMM Y');
                })
                ->addColumn('tgl_bpkb', function ($asetKendaraan) {
                    return \Carbon\Carbon::parse($asetKendaraan->tgl_bpkb)->isoFormat('D MMMM Y');
                })
                ->addColumn('harga', function ($asetKendaraan) {
                    return formatRupiah($asetKendaraan->harga, true);
                })
                ->addColumn('action', function ($asetKendaraan) {
                    return view('aset.kendaraan.actions', compact('asetKendaraan'))->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('aset.kendaraan.index', compact('asetKendaraans', 'statusAset'));
    }

    public function showDetail(Request $request)
    {
        $id = $request->input('id');
        $asetKendaraan = AsetKendaraan::with('statusAset')->findOrFail($id);

        return response()->json([
            'status_aset' => $asetKendaraan->statusAset->status_aset,
            'kode_aset' => $asetKendaraan->kode_aset,
            'tanggal_inventarisir' => Carbon::parse($asetKendaraan->tanggal_inventarisir)->isoFormat('D MMMM Y'),
            'nama' => $asetKendaraan->nama,
            'merk' => $asetKendaraan->merk,
            'type' => $asetKendaraan->type,
            'cylinder' => $asetKendaraan->cylinder,
            'warna' => $asetKendaraan->warna,
            'no_rangka' => $asetKendaraan->no_rangka,
            'no_mesin' => $asetKendaraan->no_mesin,
            'thn_pembuatan' => $asetKendaraan->thn_pembuatan,
            'thn_pembelian' => $asetKendaraan->thn_pembelian,
            'no_polisi' => $asetKendaraan->no_polisi,
            'tgl_bpkb' => Carbon::parse($asetKendaraan->tgl_bpkb)->isoFormat('D MMMM Y'),
            'no_bpkb' => $asetKendaraan->no_bpkb,
            'harga' => formatRupiah($asetKendaraan->harga, true),
            'keterangan' => $asetKendaraan->keterangan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status_aset = StatusAset::all();
        return view('aset.kendaraan.create', compact('status_aset'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAsetKendaraanRequest $request)
    {
        $validated = $request->validated();

        try {
            // Mendapatkan data yang diperlukan dari request
            $namaKendaraan = $validated['nama'];
            $thnPembelian = $validated['thn_pembelian'];

            // Menghitung jumlah kendaraan dengan jenis yang sama
            $countKendaraan = AsetKendaraan::where('nama', $namaKendaraan)->count() + 1;

            // Menentukan kode jenis kendaraan
            $kodeJenisKendaraan = ($namaKendaraan == 'Sepeda Motor') ? 'MT' : 'MB';

            // Membuat kode urutan dengan format 4 digit (0001 - 9999)
            $kodeUrutan = str_pad($countKendaraan, 4, '0', STR_PAD_LEFT);

            // Membuat kode kendaraan
            $kodeKendaraan = '02.03.' . $kodeJenisKendaraan . '.' . $thnPembelian . '.' . $kodeUrutan;

            // Simpan data ke dalam tabel aset_gedung
            $asetKendaraan = new AsetKendaraan();
            $asetKendaraan->id_status_aset = $validated['id_status_aset'];
            $asetKendaraan->kode_aset = $kodeKendaraan;
            $asetKendaraan->nama = $validated['nama'];
            $asetKendaraan->merk = $validated['merk'];
            $asetKendaraan->type = $validated['type'];
            $asetKendaraan->cylinder = $validated['cylinder'];
            $asetKendaraan->warna = $validated['warna'];
            $asetKendaraan->no_rangka = $validated['no_rangka'];
            $asetKendaraan->no_mesin = $validated['no_mesin'];
            $asetKendaraan->thn_pembuatan = $validated['thn_pembuatan'];
            $asetKendaraan->thn_pembelian = $validated['thn_pembelian'];
            $asetKendaraan->no_polisi = $validated['no_polisi'];
            $asetKendaraan->tgl_bpkb = $validated['tgl_bpkb'];
            $asetKendaraan->no_bpkb = $validated['no_bpkb'];
            $asetKendaraan->harga = $validated['harga'];
            $asetKendaraan->keterangan = $validated['keterangan'];

            // Simpan ke dalam database
            $asetKendaraan->save();

            return redirect()->route('kendaraan.index')
                ->with('success', 'Data aset kendaraan berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data aset kendaraan.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AsetKendaraan $asetKendaraan, $id_aset_kendaraan)
    {
        $id = decrypt($id_aset_kendaraan);
        $aset_kendaraan = AsetKendaraan::find($id);
        $status_aset = StatusAset::all();

        return view('aset.kendaraan.edit', compact('aset_kendaraan', 'status_aset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAsetKendaraanRequest $request)
    {
        $validated = $request->validated();

        AsetKendaraan::where('id_aset_kendaraan', $request->id_aset_kendaraan)
            ->update($validated);
        return redirect()->route('kendaraan.index')->with('success', 'Aset Kendaraan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_aset_kendaraan)
    {
        // Cek apakah aset pernah dipinjam
        $isAsetDipinjam = RiwayatPeminjamanKendaraan::where('id_aset_kendaraan', $id_aset_kendaraan)->exists();

        if ($isAsetDipinjam) {
            return redirect()->route('kendaraan.index')
                ->with('error', 'Data aset inventaris sudah pernah dipinjam, tidak dapat dihapus.');
        }

        AsetKendaraan::find($id_aset_kendaraan)->delete();
        return redirect()->route('kendaraan.index');
    }

    public function importExcel(AsetKendaraanImportRequest $request)
    {
        $file = $request->file('file');

        try {
            DB::beginTransaction();

            $file->store('public/import');

            $import = new AsetKendaraanImport;
            $import->import($file);

            if ($import->failures()->isNotEmpty()) {
                $import->customValidation($import->failures());
                DB::rollBack();
                return back()
                    ->withFailures($import->failures())
                    ->with('error', 'Gagal mengimpor data. Silakan periksa file Anda.');
            }


            if ($import->failures()->isNotEmpty()) {
                $import->customValidation($import->failures());
                DB::rollBack();
                return back()
                    ->withFailures($import->failures())
                    ->with('error', 'Gagal mengimpor data. Silakan periksa file Anda.');
            }

            $importedRowCount = $import->getRowCount();

            DB::commit();

            return redirect()->route('kendaraan.index')
                ->with('success', "Data berhasil diimpor. Total aset yang berhasil di import: $importedRowCount");

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function exportExcel()
    {
        return (new AsetKendaraanExport)->download('aset_kendaraan.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $query = AsetKendaraan::with('statusAset')->orderBy('id_aset_kendaraan');

        if ($request->opsi === 'Berdasarkan Status Aset') {
            $status_aset = $request->status_aset;
            $query->where('id_status_aset', $status_aset);

        } elseif ($request->opsi === 'Berdasarkan Jenis Kendaraan') {
            $nama = $request->nama;
            $query->where('nama', $nama);

        } elseif ($request->opsi === 'Berdasarkan Tahun Pembuatan') {
            $thn_pembuatan = $request->thn_pembuatan;
            $query->where('thn_pembuatan', $thn_pembuatan);

        } elseif ($request->opsi === 'Berdasarkan Tahun Pembelian') {
            $thn_pembelian = $request->thn_pembelian;
            $query->where('thn_pembelian', $thn_pembelian);

        } elseif ($request->opsi === 'Berdasarkan Kustom') {
            if ($request->filled('status_aset2')) {
                $status_aset2 = $request->status_aset2;
                $query->where('id_status_aset', $status_aset2);
            }

            if ($request->filled('nama2')) {
                $nama2 = $request->nama2;
                $query->where('nama', $nama2);
            }

            if ($request->filled('thn_pembuatan2')) {
                $thn_pembuatan2 = $request->thn_pembuatan2;
                $query->where('thn_pembuatan', $thn_pembuatan2);
            }

            if ($request->filled('thn_pembelian2')) {
                $thn_pembelian2 = $request->thn_pembelian2;
                $query->where('thn_pembelian', $thn_pembelian2);
            }

        }

        $aset_kendaraan = $query->get();

        // Periksa jika tidak ada hasil
        if ($aset_kendaraan->isEmpty()) {
            return redirect()->back()->with('error', 'Data yang dicari tidak ditemukan.');
        }

        $pdf = PDF::loadview('aset.kendaraan.cetak_pdf', [
            'aset_kendaraan' => $aset_kendaraan,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('aset_kendaraan.pdf');
    }
}