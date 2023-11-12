<?php

namespace App\Http\Controllers;

use App\Models\StatusAset;
use Illuminate\Http\Request;

class StatusAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status_aset = StatusAset::all();
        return view('status_aset.index', compact('status_aset'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('status_aset.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'status_aset' => 'string|required',
        ]);

        $status_aset = StatusAset::create($request->all());
        return redirect()->route('status_aset.index')
            ->with('success', 'Status Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_status_aset)
    {
        $status = StatusAset::FindOrFail($id_status_aset);
        return view('status_aset.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'status_aset' => 'required',
        ]);

        $result = StatusAset::find($request->id_status_aset)->update($request->all());
        return redirect()->route('status_aset.index')
            ->with('success', 'Status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_status_aset)
    {
        StatusAset::find($id_status_aset)->delete();
        return redirect()->route('status_aset.index')
            ->with('success', 'Status deleted successfully');
    }
}
