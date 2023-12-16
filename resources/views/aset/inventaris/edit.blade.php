@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Ubah Aset Inventaris Ruangan</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Ubah Aset Inventaris Ruangan</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('inventaris.update', $asetInventaris->id_aset_inventaris_ruangan) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="justify-center card-title">Data Aset Inventaris</h5>
                                <input type="hidden" name="id_aset_inventaris_ruangan"
                                    value="{{ $asetInventaris->id_aset_inventaris_ruangan }}">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status Aset</label>
                                            <select name="id_status_aset"
                                                class="form-select @error('status_aset') is-invalid @enderror">
                                                <option selected disabled> --Pilih Status--</option>
                                                @foreach ($status_aset as $row)
                                                    <option value="{{ $row->id_status_aset }}"
                                                        {{ (old('id_status_aset') ? old('id_status_aset') : $asetInventaris->id_status_aset) == $row->id_status_aset ? 'selected' : '' }}>
                                                        {{ $row->status_aset }}</option>
                                                @endforeach
                                            </select>
                                            @error('status_aset')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode</label>
                                            <input type="text" class="form-control" name="kode_aset"
                                                value="{{ $asetInventaris->kode_aset }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Ruangan</label>
                                    <select name="kode_ruangan"
                                        class="form-select @error('kode_ruangan') is-invalid @enderror">
                                        <option selected disabled> --Pilih Ruangan-- </option>
                                        @foreach ($kode_ruangan as $row)
                                            <option value="{{ $row->kode_ruangan }}"
                                                {{ old('kode_ruangan', $asetInventaris->kode_ruangan) == $row->kode_ruangan ? 'selected' : '' }}>
                                                {{ $row->nama }} - ({{ $row->kode_ruangan }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kode_ruangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Inventarisir</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_inventarisir') is-invalid @enderror"
                                        name="tanggal_inventarisir" autocomplete="off"
                                        value="{{ old('tanggal_inventarisir', $asetInventaris->tanggal_inventarisir) }}">
                                    @error('tanggal_inventarisir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Nama Inventaris</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        name="nama" value="{{ old('nama', $asetInventaris->nama) }}">
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Merk <span class="login-danger"
                                                    style="font-size: 12px;">*opsional</span></label>
                                            <input type="text" class="form-control @error('merk') is-invalid @enderror"
                                                name="merk" value="{{ old('merk', $asetInventaris->merk) }}">
                                            @error('merk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Volume <span class="login-danger"
                                                    style="font-size: 12px;">*opsional</span></label>
                                            <input type="text" class="form-control @error('volume') is-invalid @enderror"
                                                name="volume" value="{{ old('volume', $asetInventaris->volume) }}">
                                            @error('volume')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <h5 class="card-title">Bahan dan Kegunaan</h5>
                                <div class="form-group">
                                    <label>Bahan <span class="login-danger"
                                            style="font-size: 12px;">*opsional</span></label>
                                    <input type="text" class="form-control @error('bahan') is-invalid @enderror"
                                        name="bahan" value="{{ old('bahan', $asetInventaris->bahan) }}">
                                    @error('bahan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <input type="number" class="form-control @error('tahun') is-invalid @enderror"
                                                name="tahun" value="{{ old('tahun', $asetInventaris->tahun) }}">
                                            @error('tahun')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                                name="harga" value="{{ old('harga', $asetInventaris->harga) }}">
                                            @error('harga')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                class="form-control @error('keterangan') is-invalid @enderror"
                                                name="keterangan"
                                                value="{{ old('keterangan', $asetInventaris->keterangan) }}">
                                            @error('keterangan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jumlah</label>
                                                <input type="number"
                                                    class="form-control @error('jumlah') is-invalid @enderror"
                                                    name="jumlah" value="{{ old('jumlah', $asetInventaris->jumlah) }}">
                                                @error('jumlah')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-start">
                            <a href="{{ route('inventaris.index') }}" class="btn btn-secondary me-1"><i
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
