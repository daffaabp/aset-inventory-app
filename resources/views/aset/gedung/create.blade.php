@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tambah Aset Gedung</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Tambah Aset Gedung</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('gedung.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="justify-center card-title">Data Gedung</h5>
                                <div class="form-group">
                                    <label>Status Gedung</label>
                                    <select name="id_status_aset" class="form-select" id="id_status_aset">
                                        <option selected disabled> --Pilih Status--</option>
                                        @foreach ($status_aset as $row)
                                            <option value="{{ $row->id_status_aset }}">{{ $row->status_aset }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kode Gedung</label>
                                    <input type="text" class="form-control" name="kode_aset" autocomplete="off"
                                        autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Nama Bangunan</label>
                                    <input type="text" class="form-control" name="nama" autocomplete="off" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Kondisi</label>
                                    <input type="text" class="form-control" name="kondisi" autocomplete="off" autofocus>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bertingkat</label>
                                            <input type="text" class="form-control" name="bertingkat" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Beton</label>
                                            <input type="text" class="form-control" name="beton" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Luas Lantai (m<sup>2</sup>)</label>
                                    <input type="number" class="form-control" name="luas_lantai" autocomplete="off"
                                        autofocus>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5 class="card-title">Dokumen dan Kegunaan</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <input type="text" class="form-control" name="lokasi" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tahun Dokumen</label>
                                            <input type="number" class="form-control" name="tahun_dok" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor Dokumen</label>
                                            <input type="text" class="form-control" name="nomor_dok" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Luas (m<sup>2</sup>)</label>
                                            <input type="number" class="form-control" name="luas" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Hak Guna Bangunan</label>
                                            <select name="hak" class="form-control">
                                                <option value="HGB">HGB</option>
                                                <option value="Milik">Milik</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
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
                                            <textarea name="keterangan" rows="4" cols="4" class="form-control" placeholder="Masukkan Keterangan..."></textarea>
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
