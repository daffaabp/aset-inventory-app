<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRuanganRequest;
use App\Http\Requests\UpdateRuanganRequest;
use App\Models\AsetInventarisRuangan;
use App\Models\Ruangan;
use DataTables;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::all();

        if (request()->ajax()) {
            return Datatables::of($ruangan)
                ->addIndexColumn()
                ->addColumn('action', function ($ruang) {
                    return view('ruangan.actions', compact('ruang'))->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('ruangan.index', ['ruangan' => $ruangan]);
    }

    public function create()
    {
        return view('ruangan.create');
    }

    public function store(StoreRuanganRequest $request)
    {
        // Validasi telah dihandle oleh middleware
        $validated = $request->validated();

        try {
            $ruangan = new Ruangan();
            $ruangan->kode_ruangan = $validated['kode_ruangan'];
            $ruangan->nama = $validated['nama'];
            $ruangan->lokasi = $validated['lokasi'];

            $ruangan->save();
            return redirect()->route('ruangan.index')
                ->with('success', 'Ruangan Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data aset tanah.');
        }
    }

    public function edit($kode_ruangan)
    {
        $ruang = Ruangan::FindOrFail($kode_ruangan);
        return view('ruangan.edit', compact('ruang'));
    }

    public function update(UpdateRuanganRequest $request)
    {
        $validated = $request->validated();

        $result = Ruangan::find($request->kode_ruangan)->update($request->all());
        return redirect()->route('ruangan.index')
            ->with('success', 'Ruangan updated successfully');
    }

    public function destroy($kode_ruangan)
    {
        // Cek apakah aset pernah dipinjam
        $isStatusDigunakan = AsetInventarisRuangan::where('kode_ruangan', $kode_ruangan)->exists();

        if ($isStatusDigunakan) {
            return redirect()->route('ruangan.index')
                ->with('error', 'Ruangan sudah digunakan, tidak dapat dihapus.');
        }

        Ruangan::find($kode_ruangan)->delete();
        return redirect()->route('ruangan.index')
            ->with('success', 'Ruangan berhasil dihapus');
    }
}
