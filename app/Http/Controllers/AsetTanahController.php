<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAsetTanahRequest;
use App\Http\Requests\UpdateAsetTanahRequest;
use App\Models\AsetTanah;
use App\Models\StatusAset;

class AsetTanahController extends Controller
{

    // public function __construct() {
    //     $pe
    // }

    public function index()
    {
        $asetTanahs = AsetTanah::with('statusAset')->get();
        return view('aset.tanah.index', ['asetTanahs' => $asetTanahs]);
    }

    public function create()
    {
        $status_aset = StatusAset::all();
        return view('aset.tanah.create', compact('status_aset'));
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
        AsetTanah::find($id_aset_tanah)->delete();
        return redirect()->route('tanah.index')
            ->with('success', 'Aset Tanah berhasil dihapus.');
    }


}