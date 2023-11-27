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
                                <div class="form-group">
                                    <label>Status Kendaraan</label>
                                    <select name="id_status_aset" class="form-select" id="id_status_aset">
                                        <option selected disabled> --Pilih Status--</option>
                                        @foreach ($status_aset as $row)
                                            <option value="{{ $row->id_status_aset }}"
                                                {{ $aset_kendaraan->id_status_aset == $row->id_status_aset ? 'selected' : '' }}>
                                                {{ $row->status_aset }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kode Kendaraan</label>
                                    <input type="text" class="form-control" name="kode_aset"
                                        value="{{ $aset_kendaraan->kode_aset }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama Kendaraan</label>
                                    <input type="text" class="form-control" name="nama"
                                        value="{{ $aset_kendaraan->nama }}">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Inventarisir</label>
                                    <input type="date" class="form-control" name="tanggal_inventarisir"
                                        autocomplete="off" value="{{ $aset_kendaraan->tanggal_inventarisir }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Merk</label>
                                            <input type="text" class="form-control" name="merk"
                                                value="{{ $aset_kendaraan->merk }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <input type="text" class="form-control" name="type"
                                                value="{{ $aset_kendaraan->type }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cylinder</label>
                                            <input type="number" class="form-control" name="cylinder"
                                                value="{{ $aset_kendaraan->cylinder }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Warna</label>
                                            <input type="text" class="form-control" name="warna"
                                                value="{{ $aset_kendaraan->warna }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. Rangka</label>
                                            <input type="text" class="form-control" name="no_rangka"
                                                value="{{ $aset_kendaraan->no_rangka }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. Mesin</label>
                                            <input type="text" class="form-control" name="no_mesin"
                                                value="{{ $aset_kendaraan->no_mesin }}">
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
                                            <input type="number" class="form-control" name="thn_pembuatan"
                                                value="{{ $aset_kendaraan->thn_pembuatan }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tahun Pembelian</label>
                                            <input type="number" class="form-control" name="thn_pembelian"
                                                value="{{ $aset_kendaraan->thn_pembelian }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nomor Polisi</label>
                                            <input type="text" class="form-control" name="no_polisi"
                                                value="{{ $aset_kendaraan->no_polisi }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>TgL. BPKB</label>
                                            <input type="date" class="form-control" name="tgl_bpkb"
                                                value="{{ $aset_kendaraan->tgl_bpkb }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. BPKB</label>
                                            <input type="text" class="form-control" name="no_bpkb"
                                                value="{{ $aset_kendaraan->no_bpkb }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="number" class="form-control" name="harga"
                                                value="{{ $aset_kendaraan->harga }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" rows="4" cols="4" class="form-control"
                                                placeholder="Masukkan Keterangan...">{{ $aset_kendaraan->keterangan }}</textarea>
                                        </div>
                                    </div>
                                </div>
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
