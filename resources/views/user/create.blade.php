@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tambah User</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Tambah User</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-8 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama</label>
                            <div class="col-lg-9">
                                <input type="text" name="name" class="form-control" autocomplete="off" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Email</label>
                            <div class="col-lg-9">
                                <input type="email" name="email" class="form-control" autocomplete="off" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="roles" class="col-lg-3 col-form-label">Roles</label>
                            <div class="col-lg-9">
                                <select name="roles[]" class="form-select" id="roles"
                                    aria-label="Default select example">
                                    <option selected disabled> --Pilih Roles--</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Password</label>
                            <div class="col-lg-9">
                                <input type="password" name="password" class="form-control" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Konfirmasi Password</label>
                            <div class="col-lg-9">
                                <input type="password" name="confirm-password" class="form-control" required autofocus>
                            </div>
                        </div>

                        @can('user.store')
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
