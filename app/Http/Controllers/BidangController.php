<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;

class BidangController extends Controller
{

    public function index()
    {
        $bidangs = Bidang::all();

        if (request()->ajax()) {
            return Datatables::of($bidangs)
                ->addIndexColumn()
                ->addColumn('action', function ($bidang) {
                    return view('bidang.actions', compact('bidang'))->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('bidang.index', ['bidangs' => $bidangs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $bidangs = Bidang::all();
        return view('bidang.create', compact('bidangs'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        Bidang::create($data);
        return redirect()->route('bidang.index')
            ->with('success', 'Data Bidang berhasil disimpan.');
    }

    public function edit($id_bidang)
    {
        $bidang = Bidang::FindOrFail($id_bidang);

        return view('bidang.edit', compact('bidang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        $result = Bidang::find($request->id_bidang)->update($request->all());

        // echo '<pre>';
        // print_r($result);
        // die;
        // echo '<pre>';
        // print_r($model_bidang);
        // die;

        // if ($result) {
        //     // cek apakah berhasil simpan
        //     Session::set('crud_result', 'Berhasil Simpan');
        // } else {
        //     Session::set('crud_result', 'Gagal Simpan');
        // }

        return redirect()->route('bidang.index')
            ->with('success', 'Data Bidang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_bidang)
    {
        // Cek apakah penamaan bidang sudah pernah digunakan pada User
        $isBidangSudahDigunakan = User::where('id_bidang', $id_bidang)->exists();

        if ($isBidangSudahDigunakan) {
            return redirect()->route('bidang.index')
                ->with('error', 'Data bidang sudah digunakan pada User, tidak dapat dihapus.');
        }

        Bidang::find($id_bidang)->delete();
        return redirect()->route('bidang.index')
            ->with('success', 'Data Bidang berhasil dihapus');
    }
}