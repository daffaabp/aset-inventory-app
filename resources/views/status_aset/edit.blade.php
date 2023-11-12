@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Ubah Status Aset</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Ubah Status Aset</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <form action="{{ route('status_aset.update', $status->id_status_aset) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="id_status_aset" value="{{ $status->id_status_aset }}">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama Status</label>
                            <div class="col-lg-9">
                                <input type="text" name="status_aset" class="form-control"
                                    value="{{ $status->status_aset }}">
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
