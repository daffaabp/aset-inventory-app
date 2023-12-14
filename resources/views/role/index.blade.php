@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Role Akses Kontrol</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Role Akses Kontrol</li>
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

                            @can('role.create')
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="{{ route('role.create') }}" class="btn btn-outline-primary me-2"><i
                                            class="fas fa-plus"></i></i>
                                        Tambah Role Baru</a>
                                </div>
                            @endcan

                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table mb-0 border-0 star-student table-hover table-center datatable table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <form action="{{ route('role.destroy', $role->id) }}" method="POST">

                                                @can('role.edit')
                                                    <a class="btn btn-primary me-2" style="color: white;"
                                                        href="{{ route('role.edit', $role->id) }}">Edit</a>
                                                @endcan

                                                @can('role.destroy')
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                @endcan
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
