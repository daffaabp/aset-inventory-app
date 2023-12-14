@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tambah Aset Kendaraan</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Tambah Aset Kendaraan</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('kendaraan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="justify-center card-title">Data Kendaraan</h5>
                                <div class="form-group">
                                    <label>Status Aset</label>
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
                                    <label>Tanggal Inventarisir</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_inventarisir') is-invalid @enderror"
                                        name="tanggal_inventarisir" value="{{ \Carbon\Carbon::now()->toDateString() }}"
                                        value="{{ old('tanggal_inventarisir') }}" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Nama Kendaraan</label>
                                    <select class="form-control form-select @error('nama') is-invalid @enderror"
                                        name="nama" autocomplete="off" autofocus>
                                        <option value="Sepeda Motor" @if (old('nama') == 'Sepeda Motor') selected @endif>
                                            Sepeda Motor</option>
                                        <option value="Mobil" @if (old('nama') == 'Mobil') selected @endif>Mobil
                                        </option>
                                    </select>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Merk</label>
                                            <input type="text" class="form-control @error('merk') is-invalid @enderror"
                                                name="merk" value="{{ old('merk') }}" autocomplete="off" autofocus>
                                            @error('merk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <input type="text" class="form-control @error('type') is-invalid @enderror"
                                                name="type" value="{{ old('type') }}" autocomplete="off" autofocus>
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
                                                value="{{ old('cylinder') }}" autocomplete="off" autofocus>
                                            @error('cylinder')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Warna</label>
                                            <input type="text" class="form-control @error('warna') is-invalid @enderror"
                                                name="warna" value="{{ old('warna') }}" autocomplete="off" autofocus>
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
                                                name="no_rangka" value="{{ old('no_rangka') }}" autocomplete="off"
                                                autofocus>
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
                                                name="no_mesin" value="{{ old('no_mesin') }}" autocomplete="off" autofocus>
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
                                                name="thn_pembuatan" value="{{ old('thn_pembuatan') }}" autocomplete="off"
                                                autofocus>
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
                                                name="thn_pembelian" value="{{ old('thn_pembelian') }}"
                                                autocomplete="off" autofocus>
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
                                                name="no_polisi" value="{{ old('no_polisi') }}" autocomplete="off"
                                                autofocus>
                                            @error('no_polisi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>TgL. BPKB <span class="login-danger"
                                                    style="font-size: 12px;">*opsional</span></label>
                                            <input type="date"
                                                class="form-control @error('tgl_bpkb') is-invalid @enderror"
                                                name="tgl_bpkb" value="{{ old('tgl_bpkb') }}" autocomplete="off"
                                                autofocus>
                                            @error('tgl_bpkb')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. BPKB <span class="login-danger"
                                                style="font-size: 12px;">*opsional</span></label>
                                            <input type="text"
                                                class="form-control @error('no_bpkb') is-invalid @enderror"
                                                name="no_bpkb" value="{{ old('no_bpkb') }}" autocomplete="off"
                                                autofocus>
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
                                </div>
                            </div>
                        </div>
                        <div class="text-start">
                            <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary me-1"><i
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

@push('js')
    <script src="{{ URL::to('js/jquery.min.js') }}"></script>
    <script src="{{ URL::to('js/jquery.mask.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // ini kode untuk yang format rupiah
            $('.rupiah').mask("#.##0", {
                reverse: true
            });
        });
    </script>
@endpush
