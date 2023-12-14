@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tambah Status Aset</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Tambah Aset</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <form action="{{ route('status_aset.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama Status</label>
                            <div class="col-lg-9">
                                <input type="text" name="status_aset" class="form-control" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="text-start">
                            <a href="{{ route('status_aset.index') }}" class="btn btn-secondary me-1"><i
                                    class="fas fa-arrow-left"></i>
                                Kembali</a>
                        </div>

                        <div class="text-end" style="margin-top: -38px;">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
