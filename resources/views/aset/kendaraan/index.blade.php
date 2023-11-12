@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Aset Kendaraan</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Aset Kendaraan</li>
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
                                <a href="{{ route('kendaraan.create') }}" class="btn btn-outline-primary me-2"><i
                                        class="fas fa-plus"></i></i>
                                    Tambah Aset Kendaraan</a>
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
                                    <th>Merk</th>
                                    <th>Type</th>
                                    <th>Cylinder</th>
                                    <th>Warna</th>
                                    <th>No. Rangka</th>
                                    <th>No. Mesin</th>
                                    <th>Thn Pembuatan</th>
                                    <th>Thn Pembelian</th>
                                    <th>No. Polisi</th>
                                    <th>Tgl. BPKB</th>
                                    <th>No. BPKB</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asetKendaraans as $asetKendaraan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $asetKendaraan->statusAset->status_aset }}</td>
                                        <td>{{ $asetKendaraan->kode_aset }}</td>
                                        <td>{{ $asetKendaraan->nama }}</td>
                                        <td>{{ $asetKendaraan->merk }}</td>
                                        <td>{{ $asetKendaraan->type }}</td>
                                        <td>{{ $asetKendaraan->cylinder }}</td>
                                        <td>{{ $asetKendaraan->warna }}</td>
                                        <td>{{ $asetKendaraan->no_rangka }}</td>
                                        <td>{{ $asetKendaraan->no_mesin }}</td>
                                        <td>{{ $asetKendaraan->thn_pembuatan }}</td>
                                        <td>{{ $asetKendaraan->thn_pembelian }}</td>
                                        <td>{{ $asetKendaraan->no_polisi }}</td>
                                        <td>{{ $asetKendaraan->tgl_bpkb }}</td>
                                        <td>{{ $asetKendaraan->no_bpkb }}</td>
                                        <td>{{ $asetKendaraan->harga }}</td>
                                        <td>{{ $asetKendaraan->keterangan }}</td>
                                        <td>
                                            <form
                                                action="{{ route('kendaraan.destroy', $asetKendaraan->id_aset_kendaraan) }}"
                                                method="POST">

                                                <a class="btn btn-primary me-2" style="color: white;"
                                                    href="{{ route('kendaraan.edit', $asetKendaraan->id_aset_kendaraan) }}">Edit</a>

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
