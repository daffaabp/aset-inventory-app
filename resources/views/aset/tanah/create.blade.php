@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tambah Aset Tanah</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Tambah Aset Tanah</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('tanah.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="justify-center card-title">Data Tanah</h5>
                                <div class="form-group">
                                    <label>Status Tanah</label>
                                    <select name="id_status_aset" class="form-select" id="id_status_aset">
                                        @foreach ($status_aset as $row)
                                            <option value="{{ $row->id_status_aset }}"
                                                {{ $row->id_status_aset == 1 ? 'selected' : '' }}>{{ $row->status_aset }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kode Tanah</label>
                                    <input type="text" class="form-control" name="kode_aset" value="{{ $kode_tanah }}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Inventarisir</label>
                                    <input type="date" class="form-control" name="tanggal_inventarisir"
                                        value="{{ \Carbon\Carbon::now()->toDateString() }}" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" autocomplete="off" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Luas (m<sup>2</sup>)</label>
                                    <input type="number" class="form-control" name="luas" autocomplete="off" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Letak Tanah</label>
                                    <input type="text" class="form-control" name="letak_tanah" autocomplete="off"
                                        required autofocus>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="card-title">Sertifikat dan Kegunaan</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Hak</label>
                                            <select class="form-control form-select" name="hak" autocomplete="off"
                                                autofocus>
                                                <option value="Hak Pakai">Hak Pakai</option>
                                                <option value="Hak Milik">Hak Milik</option>
                                                <option value="Hak Guna Usaha">Hak Guna Usaha</option>
                                                <option value="Hak Guna Bangunan">Hak Guna Bangunan</option>
                                                <option value="Hak Sewa">Hak Sewa</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Sertifikat</label>
                                            <input type="date" name="tanggal_sertifikat" class="form-control"
                                                autocomplete="off" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor Sertifikat</label>
                                            <input type="text" name="no_sertifikat" class="form-control"
                                                autocomplete="off" autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Penggunaan</label>
                                            <input type="text" name="penggunaan" class="form-control" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="text" name="harga" class="form-control" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
