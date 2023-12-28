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

                                            <td>{{ $row->usersPeminjam->name }}</td>
                                            <td>
                                                @if ($row->status_verifikasi === 'Selesai')
                                                    <span class="badge"
                                                        style="background-color: blue; color: white;">Selesai</span>
                                                @elseif ($row->status_verifikasi === 'Ditolak')
                                                    <span class="badge badge-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($row->tgl_pengajuan)->isoFormat('lll') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($row->tgl_rencana_pinjam)->isoFormat('LL') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($row->tgl_rencana_kembali)->isoFormat('LL') }}</td>
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


    {{-- <div id="cetak-perBulan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Cetak Laporan Per Bulan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cetak_laporanPerBulan') }}" method="GET" enctype="multipart/form-data"
                        class="px-3" id="cetak-perBulan">
                        @csrf


                        <div class="mb-2 text-right">
                            <button class="btn btn-success" type="submit">Cetak Laporan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div> --}}
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
