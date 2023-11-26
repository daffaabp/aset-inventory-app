@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Ubah Aset Gedung</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Ubah Aset Gedung</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST"
                        action="{{ route('gedung.update', $aset_gedung->id_aset_gedung) }}"enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="justify-center card-title">Data Gedung</h5>
                                <input type="hidden" name="id_aset_gedung" value="{{ $aset_gedung->id_aset_gedung }}">
                                <div class="form-group">
                                    <label>Status Gedung</label>
                                    <select name="id_status_aset" class="form-select" id="id_status_aset">
                                        <option selected disabled> --Pilih Status--</option>
                                        @foreach ($status_aset as $row)
                                            <option value="{{ $row->id_status_aset }}"
                                                {{ $aset_gedung->id_status_aset == $row->id_status_aset ? 'selected' : '' }}>
                                                {{ $row->status_aset }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kode Gedung</label>
                                    <input type="text" class="form-control" name="kode_aset" readonly
                                        value="{{ $aset_gedung->kode_aset }}">
                                </div>
                                <div class="form-group">♦
                                    <label>Nama Bangunan</label>
                                    <input type="text" class="form-control" name="nama" autocomplete="off"
                                        value="{{ $aset_gedung->nama }}">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Inventarisir</label>
                                    <input type="date" class="form-control" name="tanggal_inventarisir"
                                        autocomplete="off" value="{{ $aset_gedung->tanggal_inventarisir }}">
                                </div>
                                <div class="form-group">
                                    <label>Kondisi</label>
                                    <input type="text" class="form-control" name="kondisi" autocomplete="off"
                                        value="{{ $aset_gedung->kondisi }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bertingkat</label>
                                            <input type="text" class="form-control" name="bertingkat" autocomplete="off"
                                                value="{{ $aset_gedung->bertingkat }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Beton</label>
                                            <input type="text" class="form-control" name="beton" autocomplete="off"
                                                value="{{ $aset_gedung->beton }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Luas Lantai (m<sup>2</sup>)</label>
                                    <input type="text" class="form-control" name="luas_lantai" autocomplete="off"
                                        value="{{ $aset_gedung->luas_lantai }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="card-title">Dokumen dan Kegunaan</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <input type="text" class="form-control" name="lokasi" autocomplete="off"
                                                value="{{ $aset_gedung->lokasi }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tahun Dokumen</label>
                                            <input type="text" class="form-control" name="tahun_dok" autocomplete="off"
                                                value="{{ $aset_gedung->tahun_dok }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor Dokumen</label>
                                            <input type="text" class="form-control" name="nomor_dok" autocomplete="off"
                                                value="{{ $aset_gedung->nomor_dok }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Luas (m<sup>2</sup>)</label>
                                            <input type="text" class="form-control" name="luas" autocomplete="off"
                                                value="{{ $aset_gedung->luas }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Hak Guna Bangunan</label>
                                            <input type="text" class="form-control" name="hak" autocomplete="off"
                                                value="{{ $aset_gedung->hak }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="number" class="form-control" name="harga" autocomplete="off"
                                                value="{{ $aset_gedung->harga }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" rows="4" cols="4" class="form-control"
                                                placeholder="Masukkan Keterangan...">{{ $aset_gedung->keterangan }}</textarea>
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
