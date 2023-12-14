@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Riwayat Peminjaman</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Riwayat Peminjaman</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">

                    <div class="table-responsive">
                        @if ($peminjamanSelesai->isEmpty())
                            <h6 style="text-align: center;">Saat ini tidak ada riwayat peminjaman yang tersedia.</h6>
                        @else
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
                                    @foreach ($peminjamanSelesai as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            @can('verifikasiPeminjamanDetails')
                                                <td>
                                                    <form
                                                        action="{{ route('verifikasiPeminjamanDetails', $row->id_peminjaman) }}">
                                                        <button type="submit" class="btn btn-primary">Lihat</button>
                                                    </form>
                                                </td>
                                            @endcan

                                            <td>{{ $row->peminjam->name }}</td>
                                            <td>
                                                @if ($row->status_verifikasi === 'Selesai')
                                                    <span class="badge"
                                                        style="background-color: blue; color: white;">Selesai</span>
                                                @elseif ($row->status_verifikasi === 'Ditolak')
                                                    <span class="badge badge-danger">Ditolak</span>
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('riwayatPeminjaman') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                    {
                        data: 'status_verifikasi',
                        name: 'status_verifikasi'
                    },
                    {
                        data: 'tgl_pengajuan',
                        name: 'tgl_pengajuan'
                    },
                    {
                        data: 'tgl_rencana_pinjam',
                        name: 'tgl_rencana_pinjam'
                    },
                    {
                        data: 'tgl_rencana_kembali',
                        name: 'tgl_rencana_kembali'
                    },
                    {
                        data: 'kegunaan',
                        name: 'kegunaan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endpush --}}
