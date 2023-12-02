@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tambah Aset Gedung</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Tambah Aset Gedung</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('gedung.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="justify-center card-title">Data Gedung</h5>
                                <div class="form-group">
                                    <label>Status Gedung</label>
                                    @php
                                        // Simpan nilai status aset sebelumnya
                                        $oldStatusAset = old('id_status_aset', $status_aset[0]->id_status_aset);
                                    @endphp
                                    <select name="id_status_aset"
                                        class="form-select @error('status_aset') is-invalid @enderror" id="id_status_aset">
                                        @foreach ($status_aset as $row)
                                            <option value="{{ $row->id_status_aset }}"
                                                {{ $row->id_status_aset == $oldStatusAset ? 'selected' : '' }}>
                                                {{ $row->status_aset }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_aset')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kode Gedung</label>
                                    <input type="text" class="form-control @error('kode_aset') is-invalid @enderror"
                                        name="kode_aset" value="{{ $kode_gedung }}" readonly>
                                    @error('status_aset')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Inventarisir</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_inventarisir') is-invalid @enderror"
                                        name="tanggal_inventarisir" value="{{ \Carbon\Carbon::now()->toDateString() }}"
                                        value="{{ old('tanggal_inventarisir') }}" autofocus>
                                    @error('tanggal_inventarisir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Bangunan</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        name="nama" value="{{ old('nama') }}" autocomplete="off" autofocus>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kondisi</label>
                                    <select name="kondisi"
                                        class="form-control form-select @error('kondisi') is-invalid @enderror">
                                        <option value="Baik" @if (old('kondisi') == 'Baik') selected @endif>Baik
                                        </option>
                                        <option value="Rusak" @if (old('kondisi') == 'Rusak') selected @endif>Rusak
                                        </option>
                                        <option value="Korosi" @if (old('kondisi') == 'Korosi') selected @endif>Korosi
                                        </option>
                                        <option value="Baru" @if (old('kondisi') == 'Baru') selected @endif>Baru
                                        </option>
                                    </select>
                                    @error('kondisi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bertingkat</label>
                                            <select name="bertingkat"
                                                class="form-control form-select @error('bertingkat') is-invalid @enderror">
                                                <option value="Tidak" @if (old('bertingkat') == 'Tidak') selected @endif>
                                                    Tidak</option>
                                                <option value="Ya" @if (old('bertingkat') == 'Ya') selected @endif>Ya
                                                </option>
                                            </select>
                                            @error('bertingkat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Beton</label>
                                            <select name="beton"
                                                class="form-control form-select @error('beton') is-invalid @enderror">
                                                <option value="Beton" @if (old('beton') == 'Beton') selected @endif>
                                                    Beton</option>
                                                <option value="Besi Beton"
                                                    @if (old('beton') == 'Besi Beton') selected @endif>Besi Beton</option>
                                                <option value="Besi" @if (old('beton') == 'Besi') selected @endif>
                                                    Besi</option>
                                                <option value="Aspal" @if (old('beton') == 'Aspal') selected @endif>
                                                    Aspal</option>
                                                <option value="Kayu" @if (old('beton') == 'Kayu') selected @endif>
                                                    Kayu</option>
                                            </select>
                                            @error('beton')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Luas Lantai (m<sup>2</sup>)</label>
                                    <input type="number" class="form-control @error('luas_lantai') is-invalid @enderror"
                                        name="luas_lantai" value="{{ old('luas_lantai') }}" autocomplete="off" autofocus>
                                    @error('luas_lantai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5 class="card-title">Dokumen dan Kegunaan</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <input type="text"
                                                class="form-control @error('lokasi') is-invalid @enderror" name="lokasi"
                                                value="{{ old('lokasi') }}" autocomplete="off" autofocus>
                                            @error('lokasi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tahun Dokumen</label>
                                            <input type="number"
                                                class="form-control @error('tahun_dok') is-invalid @enderror"
                                                name="tahun_dok" value="{{ old('tahun_dok') }}" autocomplete="off"
                                                autofocus>
                                            @error('tahun_dok')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor Dokumen</label>
                                            <input type="text"
                                                class="form-control @error('nomor_dok') is-invalid @enderror"
                                                name="nomor_dok" value="{{ old('nomor_dok') }}" autocomplete="off"
                                                autofocus>
                                            @error('nomor_dok')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Luas (m<sup>2</sup>)</label>
                                            <input type="number"
                                                class="form-control @error('luas') is-invalid @enderror" name="luas"
                                                value="{{ old('luas') }}" autocomplete="off" autofocus>
                                            @error('luas')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Hak Guna Bangunan</label>
                                            <select name="hak"
                                                class="form-control form-select @error('hak') is-invalid @enderror">
                                                <option value="HGB" @if (old('hak') == 'HGB') selected @endif>
                                                    HGB</option>
                                                <option value="Milik" @if (old('hak') == 'Milik') selected @endif>
                                                    Milik</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="number"
                                                class="form-control @error('harga') is-invalid @enderror" name="harga"
                                                value="{{ old('harga') }}" autocomplete="off" autofocus>
                                            @error('harga')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" rows="4" cols="4"
                                                class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukkan Keterangan...">{{ old('keterangan') }}</textarea>
                                            @error('keterangan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
