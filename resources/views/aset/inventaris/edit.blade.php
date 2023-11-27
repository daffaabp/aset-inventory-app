@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Ubah Aset Inventaris Ruangan</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Ubah Aset Inventaris Ruangan</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('inventaris.update', $asetInventaris->id_aset_inventaris_ruangan) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="justify-center card-title">Data Aset Inventaris</h5>
                                <input type="hidden" name="id_aset_inventaris_ruangan"
                                    value="{{ $asetInventaris->id_aset_inventaris_ruangan }}">
                                <div class="form-group">
                                    <label>Status Inventaris</label>
                                    <select name="id_status_aset" class="form-select" id="id_status_aset">
                                        <option selected disabled> --Pilih Status-- </option>
                                        @foreach ($status_aset as $row)
                                            <option value="{{ $row->id_status_aset }}"
                                                {{ $asetInventaris->id_status_aset == $row->id_status_aset ? 'selected' : '' }}>
                                                {{ $row->status_aset }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kode Inventaris</label>
                                    <input type="text" class="form-control" name="kode_aset"
                                        value="{{ $asetInventaris->kode_aset }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Ruangan</label>
                                    <select name="kode_ruangan" class="form-select" id="kode_ruangan">
                                        <option selected disabled> --Pilih Ruangan-- </option>
                                        @foreach ($kode_ruangan as $row)
                                            <option value="{{ $row->kode_ruangan }}"
                                                {{ $asetInventaris->kode_ruangan == $row->kode_ruangan ? 'selected' : '' }}>
                                                {{ $row->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama"
                                        value="{{ $asetInventaris->nama }}">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Inventarisir</label>
                                    <input type="date" class="form-control" name="tanggal_inventarisir"
                                        autocomplete="off" value="{{ $asetInventaris->tanggal_inventarisir }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Merk</label>
                                            <input type="text" class="form-control" name="merk"
                                                value="{{ $asetInventaris->merk }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Volume</label>
                                            <input type="text" class="form-control" name="volume"
                                                value="{{ $asetInventaris->volume }}">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <h5 class="card-title">Bahan dan Kegunaan</h5>
                                <div class="form-group">
                                    <label>Bahan</label>
                                    <input type="text" class="form-control" name="bahan"
                                        value="{{ $asetInventaris->bahan }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <input type="number" class="form-control" name="tahun"
                                                value="{{ $asetInventaris->tahun }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="number" class="form-control" name="harga"
                                                value="{{ $asetInventaris->harga }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text" class="form-control" name="keterangan"
                                                value="{{ $asetInventaris->keterangan }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jumlah</label>
                                                <input type="number" class="form-control" name="jumlah"
                                                    value="{{ $asetInventaris->jumlah }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary"
                                                style="margin-top: 20px;">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
