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
                                <h3 class="page-title"> </h3>
                            </div>
                        </div>
                    </div>

                    @if ($asetInventaris->isEmpty())
                        <h6 style="text-align: center;">Tidak ada data aset yang dapat dihapus massal.</h6>
                    @else
                        <div class="table-responsive">
                            <table class="table mb-0 border-0 table-bordered star-student table-hover table-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Grup Id</th>
                                        <th>Nama</th>
                                        <th>Ruangan</th>
                                        <th>Merk</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asetInventaris as $index => $inventaris)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $inventaris->grup_id }}</td>
                                            <td>{{ $inventaris->nama }}</td>
                                            <td>{{ $inventaris->nama_ruangan }}</td>
                                            <td>{{ $inventaris->merk }}</td>
                                            <td>{{ $inventaris->total_jumlah }}</td>
                                            <td>
                                                @if ($inventaris->grup_id)
                                                    <form
                                                        action="{{ route('inventaris.destroyMassal', $inventaris->grup_id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus massal?')">Hapus</button>
                                                    </form>
                                                @else
                                                    <span>Tidak dapat dihapus</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
