@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Ubah Aset Kendaraan</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Ubah Aset Kendaraan</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('kendaraan.update', $aset_kendaraan->id_aset_kendaraan) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="justify-center card-title">Data Kendaraan</h5>
                                <input type="hidden" name="id_aset_kendaraan"
                                    value="{{ $aset_kendaraan->id_aset_kendaraan }}">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status Aset</label>
                                            <select name="id_status_aset"
                                                class="form-select @error('status_aset') is-invalid @enderror">
                                                <option selected disabled> --Pilih Status--</option>
                                                @foreach ($status_aset as $row)
                                                    <option value="{{ $row->id_status_aset }}"
                                                        {{ (old('id_status_aset') ? old('id_status_aset') : $aset_kendaraan->id_status_aset) == $row->id_status_aset ? 'selected' : '' }}>
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
                                                value="{{ $aset_kendaraan->kode_aset }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nama Kendaraan</label>
                                    <select class="form-control form-select @error('nama') is-invalid @enderror"
                                        name="nama" value="{{ old('nama', $aset_kendaraan->nama) }}" autocomplete="off"
                                        autofocus>
                                        <option value="Sepeda Motor" @if (old('nama') == 'Sepeda Motor') selected @endif>
                                            Sepeda Motor</option>
                                        <option value="Mobil" @if (old('nama') == 'Mobil') selected @endif>Mobil
                                        </option>
                                    </select>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Inventarisir</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_inventarisir') is-invalid @enderror"
                                        name="tanggal_inventarisir" autocomplete="off"
                                        value="{{ old('tanggal_inventarisir', $aset_kendaraan->tanggal_inventarisir) }}">
                                    @error('tanggal_inventarisir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Merk</label>
                                            <input type="text" class="form-control @error('merk') is-invalid @enderror"
                                                name="merk" value="{{ old('merk', $aset_kendaraan->merk) }}">
                                            @error('merk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <input type="text" class="form-control @error('type') is-invalid @enderror"
                                                name="type" value="{{ old('type', $aset_kendaraan->type) }}">
                                            @error('type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cylinder</label>
                                            <input type="number"
                                                class="form-control @error('cylinder') is-invalid @enderror" name="cylinder"
                                                value="{{ old('cylinder', $aset_kendaraan->cylinder) }}">
                                            @error('cylinder')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Warna</label>
                                            <input type="text" class="form-control @error('warna') is-invalid @enderror"
                                                name="warna" value="{{ old('warna', $aset_kendaraan->warna) }}">
                                            @error('warna')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. Rangka</label>
                                            <input type="text"
                                                class="form-control @error('no_rangka') is-invalid @enderror"
                                                name="no_rangka"
                                                value="{{ old('no_rangka', $aset_kendaraan->no_rangka) }}">
                                            @error('no_rangka')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. Mesin</label>
                                            <input type="text"
                                                class="form-control @error('no_mesin') is-invalid @enderror"
                                                name="no_mesin" value="{{ old('no_mesin', $aset_kendaraan->no_mesin) }}">
                                            @error('no_mesin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5 class="card-title">Dokumen dan Kegunaan</h5>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tahun Pembuatan</label>
                                            <input type="number"
                                                class="form-control @error('thn_pembuatan') is-invalid @enderror"
                                                name="thn_pembuatan"
                                                value="{{ old('thn_pembuatan', $aset_kendaraan->thn_pembuatan) }}">
                                            @error('thn_pembuatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tahun Pembelian</label>
                                            <input type="number"
                                                class="form-control @error('thn_pembelian') is-invalid @enderror"
                                                name="thn_pembelian"
                                                value="{{ old('thn_pembelian', $aset_kendaraan->thn_pembelian) }}"
                                                readonly>
                                            @error('thn_pembelian')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nomor Polisi</label>
                                            <input type="text"
                                                class="form-control @error('no_polisi') is-invalid @enderror"
                                                name="no_polisi"
                                                value="{{ old('no_polisi', $aset_kendaraan->no_polisi) }}">
                                            @error('no_polisi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>TgL. BPKB</label>
                                            <input type="date"
                                                class="form-control @error('tgl_bpkb') is-invalid @enderror"
                                                name="tgl_bpkb" value="{{ old('tgl_bpkb', $aset_kendaraan->tgl_bpkb) }}">
                                            @error('tgl_bpkb')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. BPKB</label>
                                            <input type="text"
                                                class="form-control @error('no_bpkb') is-invalid @enderror"
                                                name="no_bpkb" value="{{ old('no_bpkb', $aset_kendaraan->no_bpkb) }}">
                                            @error('no_bpkb')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="number"
                                                class="form-control @error('harga') is-invalid @enderror" name="harga"
                                                value="{{ old('harga', $aset_kendaraan->harga) }}">
                                            @error('harga')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" rows="4" cols="4"
                                                class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukkan Keterangan...">{{ old('keterangan', $aset_kendaraan->keterangan) }}</textarea>
                                            @error('keterangan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-start">
                            <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary me-1"><i
                                    class="fas fa-arrow-left"></i>
                                Kembali</a>
                        </div>
                        <div class="text-end" style="margin-top: -38px;">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ URL::to('js/jquery.min.js') }}"></script>
    <script src="{{ URL::to('js/jquery.mask.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // ini kode untuk yang format rupiah
            $('.rupiah').mask("#.##0.000", {
                reverse: true
            });
        });
    </script>
@endpush
