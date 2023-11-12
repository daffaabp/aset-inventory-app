<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAsetGedungRequest;
use App\Http\Requests\UpdateAsetGedungRequest;
use App\Models\AsetGedung;
use App\Models\StatusAset;

class AsetGedungController extends Controller
{

    public function index()
    {
        $asetGedungs = AsetGedung::with('statusAset')->get();
        return view('aset.gedung.index', ['asetGedungs' => $asetGedungs]);
    }

    public function create()
    {
        $status_aset = StatusAset::all();
        return view('aset.gedung.create', compact('status_aset'));
    }

    public function store(StoreAsetGedungRequest $request)
    {

        $validated = $request->validated();

        try {
            // Simpan data ke dalam tabel aset_gedung
            $asetGedung = new AsetGedung();
            $asetGedung->id_status_aset = $validated['id_status_aset'];
            $asetGedung->kode_aset = $validated['kode_aset'];
            $asetGedung->nama = $validated['nama'];
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
        $aset_gedung = AsetGedung::find($id_aset_gedung);
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
        AsetGedung::find($id_aset_gedung)->delete();
        return redirect()->route('gedung.index')
            ->with('success', 'Aset Gedung berhasil dihapus.');
    }
}
