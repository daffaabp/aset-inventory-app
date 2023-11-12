<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAsetInventarisRuanganRequest;
use App\Http\Requests\UpdateAsetInventarisRuanganRequest;
use App\Models\AsetInventarisRuangan;
use App\Models\Ruangan;
use App\Models\StatusAset;

class AsetInventarisRuanganController extends Controller
{

    public function index()
    {
        $asetInventaris = AsetInventarisRuangan::with(['statusAset'])->get();
        return view('aset.inventaris.index', compact('asetInventaris'));
    }

    public function create()
    {
        $status_aset = StatusAset::all();
        $ruangan = Ruangan::all();
        return view('aset.inventaris.create', compact('status_aset', 'ruangan'));
    }

    public function store(StoreAsetInventarisRuanganRequest $request)
    {
        // Validasi telah dihandle oleh middleware
        $validated = $request->validated();
        // echo '<pre>';
        // print_r($validated);
        // die;
        try {
            // Simpan data ke dalam tabel aset_gedung
            $asetInventaris = new AsetInventarisRuangan();
            $asetInventaris->id_status_aset = $validated['id_status_aset'];
            $asetInventaris->kode_ruangan = $validated['kode_ruangan'];
            $asetInventaris->kode_aset = $validated['kode_aset'];
            $asetInventaris->nama = $validated['nama'];
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
        AsetInventarisRuangan::find($id_aset_inventaris_ruangan)->delete();
        return redirect()->route('inventaris.index')
            ->with('success', 'Aset Gedung berhasil dihapus.');
    }
}
