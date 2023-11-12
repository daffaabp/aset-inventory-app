<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bidangs = Bidang::select('id_bidang', 'nama', 'deskripsi')->get();
        return view('bidang.index', compact('bidangs'));
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
            ->with('success', 'Bidang baru berhasil disimpan.');
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
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_bidang)
    {
        Bidang::find($id_bidang)->delete();
        return redirect()->route('bidang.index')
            ->with('success', 'Product deleted successfully');
    }
}