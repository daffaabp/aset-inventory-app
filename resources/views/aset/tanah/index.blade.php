@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Aset Tanah</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Aset Tanah</li>
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
                                <a href="{{ route('tanah.create') }}" class="btn btn-outline-primary me-2"><i
                                        class="fas fa-plus"></i></i>
                                    Tambah Aset Tanah</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table mb-0 border-0 table-bordered star-student table-hover table-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status Tanah</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Luas (m<sup>2</sup>)</th>
                                    <th>Letak Tanah</th>
                                    <th>Hak</th>
                                    <th>Tgl. Sertifikat</th>
                                    <th>No. Sertifikat</th>
                                    <th>Penggunaan</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asetTanahs as $asetTanah)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $asetTanah->statusAset->status_aset }}</td>
                                        <td>{{ $asetTanah->kode_aset }}</td>
                                        <td>{{ $asetTanah->nama }}</td>
                                        <td>{{ $asetTanah->luas }}</td>
                                        <td>{{ $asetTanah->letak_tanah }}</td>
                                        <td>{{ $asetTanah->hak }}</td>
                                        <td>{{ \Carbon\Carbon::parse($asetTanah->tanggal_sertifika)->format('d-F-Y') }}
                                        </td>
                                        <td>{{ $asetTanah->no_sertifikat }}</td>
                                        <td>{{ $asetTanah->penggunaan }}</td>
                                        <td>{{ $asetTanah->harga }}</td>
                                        <td>{{ $asetTanah->keterangan }}</td>
                                        <td>
                                            <form action="{{ route('tanah.destroy', $asetTanah->id_aset_tanah) }}"
                                                method="POST">

                                                <a class="btn btn-primary me-2" style="color: white;"
                                                    href="{{ route('tanah.edit', $asetTanah->id_aset_tanah) }}">Edit</a>

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
