<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Models\AsetInventarisRuangan;

class RuanganController extends Controller
{

    public function index()
    {

        $ruangan = Ruangan::all();
        return view('ruangan.index', compact('ruangan'));
    }

    public function create()
    {
        return view('ruangan.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_ruangan' => 'string|required',
            'nama' => 'string|required',
            'lokasi' => 'string|required',
        ]);

        $ruangan = Ruangan::create($request->all());
        return redirect()->route('ruangan.index')
            ->with('success', 'Ruangan Berhasil Ditambahkan');
    }

    public function edit($kode_ruangan)
    {
        $ruang = Ruangan::FindOrFail($kode_ruangan);
        return view('ruangan.edit', compact('ruang'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'kode_ruangan' => 'string|required',
            'nama' => 'string|required',
            'lokasi' => 'string|required',
        ]);

        $result = Ruangan::find($request->kode_ruangan)->update($request->all());
        return redirect()->route('ruangan.index')
            ->with('success', 'Ruangan updated successfully');
    }

    public function destroy($kode_ruangan)
    {
        Ruangan::find($kode_ruangan)->delete();
        return redirect()->route('ruangan.index')
            ->with('success', 'Ruangan deleted successfully');
    }
}