@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Ubah Bidang</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Ubah Bidang</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-7 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <form action="{{ route('bidang.update', $bidang->id_bidang) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id_bidang" value="{{ $bidang->id_bidang }}">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama Bidang</label>
                            <div class="col-lg-9">
                                <input type="text" name="nama" class="form-control" value="{{ $bidang->nama }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Deskripsi</label>
                            <div class="col-lg-9">
                                <textarea name="deskripsi" rows="4" cols="5" class="form-control" placeholder="Enter message">{{ $bidang->deskripsi }}</textarea>
                            </div>
                        </div>

                        @can('bidang.update')
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        @endcan

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
