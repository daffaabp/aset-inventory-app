@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Jenis Bidang / Peran</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Jenis Bidang / Peran</li>
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
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="{{ route('bidang.create') }}" class="btn btn-outline-primary me-2"><i
                                        class="fas fa-plus"></i></i>
                                    Tambah Bidang</a>
                            </div>
                        </div>
                    </div>

                    @if ($message = Session::get('crud_result'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="datatable"
                            class="table mb-0 border-0 table-bordered star-student table-hover table-center table-stripped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Bidang</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
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
                ajax: "{{ route('bidang.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
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

        @if (Session::has('success'))
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.success("{{ Session::get('success') }}", 'Berhasil!', {
                timeOut: 5000,
            });
        @elseif (Session::has('warning'))
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.warning("{{ Session::get('warning') }}", 'Peringatan!', {
                timeOut: 5000,
            });
        @endif
    </script>
@endpush
