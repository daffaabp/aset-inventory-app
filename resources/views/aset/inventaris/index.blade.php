@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Aset Inventaris Ruangan</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Aset Inventaris Ruangan</li>
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
                                <a href="{{ route('inventaris.create') }}" class="btn btn-outline-primary me-2"><i
                                        class="fas fa-plus"></i></i>
                                    Tambah Aset Inventaris</a>
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
                                    <th>Ruangan</th>
                                    <th>Nama</th>
                                    <th>Merk</th>
                                    <th>Volume</th>
                                    <th>Bahan</th>
                                    <th>Tahun</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asetInventaris as $inventaris)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $inventaris->statusAset->status_aset }}</td>
                                        <td>{{ $inventaris->kode_aset }}</td>
                                        <td>{{ $inventaris->ruangan->nama }}</td>
                                        <td>{{ $inventaris->nama }}</td>
                                        <td>{{ $inventaris->merk }}</td>
                                        <td>{{ $inventaris->volume }}</td>
                                        <td>{{ $inventaris->bahan }}</td>
                                        <td>{{ $inventaris->tahun }}</td>
                                        <td>{{ $inventaris->harga }}</td>
                                        <td>{{ $inventaris->keterangan }}</td>
                                        <td>{{ $inventaris->jumlah }}</td>
                                        <td>
                                            <form action="{{ route('inventaris.destroy', $inventaris->id_aset_inventaris_ruangan) }}"
                                                method="POST">

                                                <a class="btn btn-primary me-2" style="color: white;"
                                                    href="{{ route('inventaris.edit', $inventaris->id_aset_inventaris_ruangan) }}">Edit</a>

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
