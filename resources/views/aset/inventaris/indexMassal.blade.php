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
                            <table id="datatable"
                                class="table mb-0 border-0 table-bordered star-student table-hover table-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Grup Id</th>
                                        <th>Nama Inventaris</th>
                                        <th>Ruangan</th>
                                        <th>Merk</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('inventaris.indexMassal') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'grup_id',
                        name: 'grup_id'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'nama_ruangan',
                        name: 'nama_ruangan'
                    },
                    {
                        data: 'merk',
                        name: 'merk'
                    },
                    {
                        data: 'total_jumlah',
                        name: 'total_jumlah'
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
@endpush
