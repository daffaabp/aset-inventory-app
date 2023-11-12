@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Ubah Ruangan</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Ubah Ruangan</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <form action="{{ route('ruangan.update', $ruang->kode_ruangan) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Kode Ruangan</label>
                            <div class="col-lg-9">
                                <input type="text" name="kode_ruangan" class="form-control"
                                    value="{{ $ruang->kode_ruangan }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama Ruangan</label>
                            <div class="col-lg-9">
                                <input type="text" name="nama" class="form-control" value="{{ $ruang->nama }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Lokasi</label>
                            <div class="col-lg-9">
                                <input type="text" name="lokasi" class="form-control" value="{{ $ruang->lokasi }}">
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
