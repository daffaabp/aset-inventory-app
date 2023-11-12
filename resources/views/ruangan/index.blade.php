@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Data Ruangan</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Data Ruangan</li>
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
                                <a href="{{ route('ruangan.create') }}" class="btn btn-outline-primary me-2"><i
                                        class="fas fa-plus"></i></i>
                                    Tambah Ruangan</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table mb-0 border-0 star-student table-hover table-center datatable table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Ruangan</th>
                                    <th>Nama Ruangan</th>
                                    <th>Lokasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ruangan as $ruang)
                                    <?php
                                    // print_r($ruang->kode_ruangan);
                                    // die();
                                    ?>
                                    <tr>
                                        <td>{{ $ruang->kode_ruangan }}</td>
                                        <td>{{ $ruang->nama }}</td>
                                        <td>{{ $ruang->lokasi }}</td>
                                        <td>
                                            <form action="{{ route('ruangan.destroy', $ruang->kode_ruangan) }}"
                                                method="POST">

                                                <a class="btn btn-primary me-2" style="color: white;"
                                                    href="{{ route('ruangan.edit', $ruang->kode_ruangan) }}">Edit</a>

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
