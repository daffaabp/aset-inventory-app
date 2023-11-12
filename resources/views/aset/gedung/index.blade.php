@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Aset Gedung</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Aset Gedung</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">

                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title"></h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="{{ route('gedung.create') }}" class="btn btn-outline-primary me-2"><i
                                        class="fas fa-plus"></i></i>
                                    Tambah Aset Gedung</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table mb-0 border-0 table-bordered star-student table-hover table-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Kondisi</th>
                                    <th>Bertingkat</th>
                                    <th>Beton</th>
                                    <th>Luas Lantai (m<sup>2</sup>)</th>
                                    <th>Lokasi</th>
                                    <th>Tahun Dokumen</th>
                                    <th>No Dokumen</th>
                                    <th>Luas Tanah (m<sup>2</sup>)</th>
                                    <th>Hak</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asetGedungs as $asetGedung)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $asetGedung->statusAset->status_aset }}</td>
                                        <td>{{ $asetGedung->kode_aset }}</td>
                                        <td>{{ $asetGedung->nama }}</td>
                                        <td>{{ $asetGedung->kondisi }}</td>
                                        <td>{{ $asetGedung->bertingkat }}</td>
                                        <td>{{ $asetGedung->beton }}</td>
                                        <td>{{ $asetGedung->luas_lantai }}</td>
                                        <td>{{ $asetGedung->lokasi }}</td>
                                        <td>{{ $asetGedung->tahun_dok }}</td>
                                        <td>{{ $asetGedung->nomor_dok }}</td>
                                        <td>{{ $asetGedung->luas }}</td>
                                        <td>{{ $asetGedung->hak }}</td>
                                        <td>{{ $asetGedung->harga }}</td>
                                        <td>{{ $asetGedung->keterangan }}</td>
                                        <td>
                                            <form action="{{ route('gedung.destroy', $asetGedung->id_aset_gedung) }}"
                                                method="POST">

                                                <a class="btn btn-primary me-2" style="color: white;"
                                                    href="{{ route('gedung.edit', $asetGedung->id_aset_gedung) }}">Edit</a>

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
