@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Ubah Aset Tanah</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Ubah Aset Tanah</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('tanah.update', $aset_tanah->id_aset_tanah) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="justify-center card-title">Data Tanah</h5>
                                <input type="hidden" name="id_aset_tanah" value="{{ $aset_tanah->id_aset_tanah }}">
                                <div class="form-group">
                                    <label>Status Tanah</label>
                                    <select name="id_status_aset" class="form-select" id="id_status_aset">
                                        <option selected disabled> --Pilih Status--</option>
                                        @foreach ($status_aset as $row)
                                            <option value="{{ $row->id_status_aset }}"
                                                {{ $aset_tanah->id_status_aset == $row->id_status_aset ? 'selected' : '' }}>
                                                {{ $row->status_aset }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kode Tanah</label>
                                    <input type="text" class="form-control" name="kode_aset" readonly
                                        value="{{ $aset_tanah->kode_aset }}">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" autocomplete="off"
                                        value="{{ $aset_tanah->nama }}">
                                </div>
                                <div class="form-group">
                                    <label>Luas (m<sup>2</sup>)</label>
                                    <input type="text" class="form-control" name="luas" autocomplete="off"
                                        value="{{ $aset_tanah->luas }}">
                                </div>
                                <div class="form-group">
                                    <label>Letak Tanah</label>
                                    <input type="text" class="form-control" name="letak_tanah"
                                        value="{{ $aset_tanah->letak_tanah }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="card-title">Sertifikat dan Kegunaan</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Hak</label>
                                            <input type="text" name="hak" class="form-control"
                                                value="{{ $aset_tanah->hak }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Sertifikat</label>
                                            <input type="date" name="tanggal_sertifikat"
                                                value="{{ $aset_tanah->tanggal_sertifikat }}" class="form-control"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor Sertifikat</label>
                                            <input type="text" name="no_sertifikat" class="form-control"
                                                value="{{ $aset_tanah->no_sertifikat }}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Penggunaan</label>
                                            <input type="text" name="penggunaan" class="form-control"
                                                value="{{ $aset_tanah->penggunaan }}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="varchar" name="harga" class="form-control"
                                                value="{{ $aset_tanah->harga }}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" rows="4" cols="4" class="form-control" placeholder="Masukkan Keterangan...">{{ $aset_tanah->keterangan }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
