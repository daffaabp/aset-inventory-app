@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tambah Aset Inventaris Ruangan</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Tambah Aset Inventaris Ruangan</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="justify-center card-title">Data Aset Inventaris</h5>
                                <div class="form-group">
                                    <label>Status Inventaris</label>
                                    <select name="id_status_aset" class="form-select" id="id_status_aset">
                                        <option selected disabled> --Pilih Status-- </option>
                                        @foreach ($status_aset as $row)
                                            <option value="{{ $row->id_status_aset }}">{{ $row->status_aset }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kode Inventaris</label>
                                    <input type="text" class="form-control" name="kode_aset" autocomplete="off"
                                        autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Ruangan</label>
                                    <select name="kode_ruangan" class="form-select" id="kode_ruangan">
                                        <option selected disabled> --Pilih Ruangan-- </option>
                                        @foreach ($ruangan as $row)
                                            <option value="{{ $row->kode_ruangan }}">{{ $row->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" autocomplete="off" autofocus>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Merk</label>
                                            <input type="text" class="form-control" name="merk" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Volume</label>
                                            <input type="text" class="form-control" name="volume" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5 class="card-title">Bahan dan Kegunaan</h5>
                                <div class="form-group">
                                    <label>Bahan</label>
                                    <input type="text" class="form-control" name="bahan" autocomplete="off" autofocus>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <input type="number" class="form-control" name="tahun" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="text" class="form-control" name="harga" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text" class="form-control" name="keterangan" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input type="number" class="form-control" name="jumlah" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
