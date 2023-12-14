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
                                <input type="text" name="name" class="form-control" autocomplete="off" required
                                    autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Email</label>
                            <div class="col-lg-9">
                                <input type="email" name="email" class="form-control" autocomplete="off" required
                                    autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="roles" class="col-lg-3 col-form-label">Roles</label>
                            <div class="col-lg-9">
                                <select name="roles[]" class="form-control form-select" id="roles"
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
                            <label for="bidang" class="col-lg-3 col-form-label">Bidang</label>
                            <div class="col-lg-9">
                                <select name="id_bidang" class="form-control form-select" id="bidang"
                                    aria-label="Default select example">
                                    <option selected disabled>-- Pilih Bidang --</option>
                                    @foreach ($bidangs as $bidang)
                                        <option value="{{ $bidang->id_bidang }}" data-keterangan="{{ $bidang->deskripsi }}">
                                            {{ $bidang->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-lg-3 col-form-label">Keterangan</label>
                            <div class="col-lg-9">
                                <textarea name="keterangan_bidang" id="keterangan_bidang" rows="4" cols="5" class="form-control"
                                    placeholder="Masukkan Keterangan..."></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foto" class="col-lg-3 col-form-label">Upload Foto</label>
                            <div class="col-lg-9">
                                <input type="file" class="form-control" name="foto" accept="image/*"
                                    aria-label="Pilih Foto" placeholder="Pilih Foto">
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

                        <div class="text-start">
                            <a href="{{ route('user.index') }}" class="btn btn-secondary me-1"><i
                                    class="fas fa-arrow-left"></i>
                                Kembali</a>
                        </div>

                        @can('user.store')
                            <div class="text-end" style="margin-top: -38px;">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var bidangSelect = document.getElementById('bidang');
            var keteranganTextarea = document.getElementById('keterangan_bidang');

            bidangSelect.addEventListener('change', function() {
                var selectedOption = bidangSelect.options[bidangSelect.selectedIndex];
                var keterangan = selectedOption.getAttribute('data-keterangan');

                // Isi nilai keterangan ke dalam textarea
                keteranganTextarea.value = keterangan;
            });
        });
    </script>
@endpush
