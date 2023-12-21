@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">User Managemen</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">User Managemen</li>
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
                                                @foreach ($user->getRoleNames() as $row)
                                                    @if ($row == 'Superadmin')
                                                        <div class="badge" style="background-color: red;">Superadmin</div>
                                                    @elseif($row == 'Petugas')
                                                        <div class="badge" style="background-color: green;">Petugas</div>
                                                    @elseif($row == 'Sekretaris Kwarcab')
                                                        <div class="badge" style="background-color: blue;">Sekretaris
                                                            Kwarcab</div>
                                                    @elseif($row == 'Sekretaris Bidang')
                                                        <div class="badge" style="background-color: orange;">Sekretaris
                                                            Bidang</div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">

                                                @can('user.edit')
                                                    <a class="btn btn-warning me-2" style="color: white;"
                                                        href="{{ route('user.edit', $user->id) }}">Edit</a>
                                                @endcan

                                                @can('user.destroy')
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger me-2">Hapus</button>
                                                @endcan

                                                <a class="btn btn-success me-2" style="color: white;" href="">Login
                                                    As</a>
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
