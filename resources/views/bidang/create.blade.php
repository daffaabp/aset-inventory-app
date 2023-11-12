@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tambah Bidang</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Tambah Bidang</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-7 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <form action="{{ route('bidang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama Bidang</label>
                            <div class="col-lg-9">
                                <input type="text" name="nama" class="form-control" autocomplete="off" required
                                    autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Deskripsi</label>
                            <div class="col-lg-9">
                                <textarea name="deskripsi" rows="4" cols="5" class="form-control" placeholder="Enter message"></textarea>
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
