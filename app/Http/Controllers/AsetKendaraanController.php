<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAsetKendaraanRequest;
use App\Http\Requests\UpdateAsetKendaraanRequest;
use App\Models\AsetKendaraan;
use App\Models\StatusAset;

class AsetKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asetKendaraans = AsetKendaraan::with('statusAset')->get();
        return view('aset.kendaraan.index', ['asetKendaraans' => $asetKendaraans]);
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
        // echo '<pre>';
        // print_r($validated);
        // die;
        try {
            // Simpan data ke dalam tabel aset_gedung
            $asetKendaraan = new AsetKendaraan();
            $asetKendaraan->id_status_aset = $validated['id_status_aset'];
            $asetKendaraan->kode_aset = $validated['kode_aset'];
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
        $aset_kendaraan = AsetKendaraan::find($id_aset_kendaraan);
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
        AsetKendaraan::find($id_aset_kendaraan)->delete();
        return redirect()->route('kendaraan.index')
            ->with('success', 'Aset Kendaraan berhasil dihapus.');
    }
}
