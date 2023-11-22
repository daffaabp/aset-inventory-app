@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Verifikasi Peminjaman</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Verifikasi Peminjaman</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">

                    <div class="table-responsive">
                        @if ($peminjaman->isNotEmpty())
                            <table
                                class="table mb-0 border-0 star-student table-hover table-center datatable table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        @can('verifikasiPeminjamanDetails')
                                            <th>Aksi</th>
                                        @endcan
                                        <th>Peminjam</th>
                                        <th>Status Verifikasi</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Tanggal Rencana Pinjam</th>
                                        <th>Tanggal Rencana Kembali</th>
                                        <th>Kegunaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjaman as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            @can('verifikasiPeminjamanDetails')
                                                <td>
                                                    @if ($row->status_verifikasi === 'Dikirim')
                                                        <form
                                                            action="{{ route('verifikasiPeminjamanDetails', $row->id_peminjaman) }}">
                                                            <button type="submit" class="btn btn-warning">Proses</button>
                                                        </form>
                                                    @elseif($row->status_verifikasi === 'ACC')
                                                        <form
                                                            action="{{ route('verifikasiPeminjamanDetails', $row->id_peminjaman) }}">
                                                            <button type="submit" class="btn btn-success">Proses</button>
                                                        </form>
                                                    @else
                                                        <form
                                                            action="{{ route('verifikasiPeminjamanDetails', $row->id_peminjaman) }}">
                                                            <button type="submit" class="btn btn-primary">Lihat</button>
                                                        </form>
                                                    @endif

                                                </td>
                                            @endcan
                                            <td>{{ $row->peminjam->name }}</td>
                                            <td>
                                                @if ($row->status_verifikasi === 'ACC')
                                                    <span class="badge badge-success">ACC (Sedang Dipinjam)</span>
                                                @elseif ($row->status_verifikasi === 'Dikirim')
                                                    <span class="badge badge-warning">Dikirim</span>
                                                @else
                                                    <span class="badge badge-primary">Selesai</span>
                                                @endif
                                            </td>
                                            <td>{{ $row->tgl_pengajuan }}</td>
                                            <td>{{ $row->tgl_rencana_pinjam }}</td>
                                            <td>{{ $row->tgl_rencana_kembali }}</td>
                                            <td>{{ $row->kegunaan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h6 style="text-align: center;">Saat ini tidak ada permintaan peminjaman yang di verifikasi.
                            </h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
