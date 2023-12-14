@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Ubah User</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Ubah User</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-8 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama</label>
                            <div class="col-lg-9">
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $user->name) }}" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Email</label>
                            <div class="col-lg-9">
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="roles" class="col-lg-3 col-form-label">Role:</label>
                            <div class="col-lg-9">
                                <select name="roles[]" class="form-control form-select" id="roles"
                                    aria-label="Default select example" @if ($isSuperadmin) disabled @endif>
                                    @foreach ($roles as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ in_array($key, $userRole) ? 'selected' : '' }}>{{ $value }}</option>
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
                                        <option value="{{ $bidang->id_bidang }}"
                                            {{ $user->id_bidang == $bidang->id_bidang ? 'selected' : '' }}
                                            data-keterangan="{{ $bidang->deskripsi }}">
                                            {{ $bidang->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-lg-3 col-form-label">Keterangan Bidang</label>
                            <div class="col-lg-9">
                                <textarea name="keterangan_bidang" rows="4" cols="5" class="form-control" id="keterangan_bidang"
                                    placeholder="Masukkan Keterangan...">{{ old('keterangan_bidang', $user->keterangan_bidang) }}</textarea>
                            </div>
                        </div>

                        <!-- Container untuk menampilkan foto lama -->
                        <div class="form-group row">
                            <label for="foto" class="col-lg-3 col-form-label">Foto Saat Ini</label>
                            <div class="col-lg-9">
                                <div id="fotoPreviewContainer">
                                    @if ($user->foto)
                                        <div class="rounded-circle overflow-hidden" style="width: 100px; height: 100px;">
                                            <img class="w-100 h-100 object-cover"
                                                src="{{ asset('storage/' . $user->foto) }}" alt="User Photo"
                                                class="img-thumbnail">
                                        </div>
                                    @else
                                        <p>Tidak ada foto.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- <!-- Input untuk upload foto baru -->
                        <div class="form-group row">
                            <label for="foto" class="col-lg-3 col-form-label">Upload Foto Baru</label>
                            <div class="col-lg-6">
                                <input type="file" class="form-control" name="foto" id="uploadFoto" accept="image/*"
                                    aria-label="Pilih Foto" placeholder="Pilih Foto">
                            </div>
                        </div> --}}



                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Password</label>
                            <div class="col-lg-9">
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Konfirmasi Password</label>
                            <div class="col-lg-9">
                                <input type="password" name="confirm-password" class="form-control">
                            </div>
                        </div>

                        <div class="text-start">
                            <a href="{{ route('user.index') }}" class="btn btn-secondary me-1"><i
                                    class="fas fa-arrow-left"></i>
                                Kembali</a>
                        </div>

                        @can('user.update')
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
