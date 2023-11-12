@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">User Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">User Management</li>
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

                            @can('user.create')
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="{{ route('user.create') }}" class="btn btn-outline-primary me-2"><i
                                            class="fas fa-plus"></i></i>
                                        Tambah User Baru</a>
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
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>

                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $v)
                                                    {{-- <label class="badge badge-success">{{ $v }}</label> --}}
                                                    @if ($v == 'Superadmin')
                                                        <div class="badge" style="background-color: red;">Superadmin</div>
                                                    @elseif($v == 'Petugas')
                                                        <div class="badge" style="background-color: green;">Petugas</div>
                                                    @elseif($v == 'Sekretaris Kwarcab')
                                                        <div class="badge" style="background-color: blue;">Sekretaris
                                                            Kwarcab</div>
                                                    @elseif($v == 'Sekretaris Bidang')
                                                        <div class="badge" style="background-color: orange;">Sekretaris
                                                            Bidang</div>
                                                    @endif
                                                @endforeach
                                            @endif

                                        </td>
                                        <td>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">

                                                @can('user.edit')
                                                    <a class="btn btn-primary me-2" style="color: white;"
                                                        href="{{ route('user.edit', $user->id) }}">Edit</a>
                                                @endcan

                                                @can('user.destroy')
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
