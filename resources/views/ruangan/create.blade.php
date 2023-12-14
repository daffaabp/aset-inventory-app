@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tambah Ruangan</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Tambah Ruangan</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 d-flex">
            <div class="card flex-fill">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


                <div class="card-body">
                    <form action="{{ route('ruangan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Kode Ruangan</label>
                            <div class="col-lg-9">
                                <input type="text" name="kode_ruangan" value="{{ old('kode_ruangan') }}"
                                    class="form-control @error('kode_ruangan') is-invalid @enderror" autocomplete="off">
                                @error('kode_ruangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama Ruangan</label>
                            <div class="col-lg-9">
                                <input type="text" name="nama" value="{{ old('nama') }}"
                                    class="form-control @error('nama') is-invalid @enderror" autocomplete="off">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Lokasi</label>
                            <div class="col-lg-9">
                                <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                                    class="form-control @error('lokasi') is-invalid @enderror" autocomplete="off">
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="text-start">
                            <a href="{{ route('ruangan.index') }}" class="btn btn-secondary me-1"><i
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
