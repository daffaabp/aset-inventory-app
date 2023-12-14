@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tambah Peran dan Izin</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Tambah Bidang</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">

                <form action="{{ route('role.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title"></h3>
                                </div>
                                <div class="col-auto text-end ms-auto download-grp">
                                    <a href="{{ route('role.getRoutesAllJson') }}" class="btn btn-outline-primary me-2"><i
                                            class="fas fa-undo"></i></i>
                                        Refresh Permissions</a>

                                    <a href="{{ route('role.getRefreshAndDeleteJson') }}"
                                        class="btn btn-warning btn-outline-warning me-2" style="color: white;"><i
                                            class="fas fa-undo"></i></i>
                                        Refresh & Delete Permissions</a>

                                    <button type="submit" class="btn btn-success btn-outline-success me-2"
                                        style="color: white"><i class="fas fa-save"></i> Simpan</button>
                                </div>
                            </div>
                        </div>

                        <div class="text-start" style="margin-top: -70px;">
                            <a href="{{ route('role.index') }}" class="btn btn-secondary me-1"><i
                                    class="fas fa-arrow-left"></i>
                                Kembali</a>
                        </div>

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 10px;">
                            <div class="form-group">
                                <strong>Nama Role:</strong>
                                <br>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Role name" autofocus autocomplete="off" style="margin-top: 10px;">
                            </div>
                            <strong>Permission:</strong>
                            <br> <br>
                            @foreach ($permission as $value)
                                <tr>
                                    <div class="form-check">
                                        <input type="checkbox" name="permission[]" value="{{ $value->id }}"
                                            class="form-check-input" id="permission{{ $value->id }}">
                                        <label class="form-check-label" for="permission{{ $value->id }}">
                                            {{ $value->name }}
                                        </label>
                                    </div>
                                </tr>
                            @endforeach
                        </div>


                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
