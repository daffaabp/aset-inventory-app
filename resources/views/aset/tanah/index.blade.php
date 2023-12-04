@extends('layouts.master')
@section('content')
    @push('css')
        <style>
            .import-excel {
                text-align: center;
                margin: 0 auto;
                padding-left: 240px;
            }
        </style>
    @endpush

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Aset Tanah</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Aset Tanah</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">

                    <div class="page-header">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="{{ route('tanah.create') }}" class="btn btn-outline-primary me-1"><i
                                        class="fas fa-plus"></i></i>
                                    Tambah Aset</a>

                                <button type="button" class="btn btn-success btn-md me-1" data-bs-toggle="modal"
                                    data-bs-target="#import-modal" data-class="import-excel"><i
                                        class="fas fa-file-import"></i>
                                    Import Excel</button>

                                <a href="#" class="btn btn-warning btn-md me-1 cetak-excel"><i
                                        class="fas fa-file-export"></i> Cetak Excel</a>


                                <a href="{{ route('tanah.exportPdf') }}" class="btn btn-danger btn-md me-1"
                                    target="_blank"><i class="fas fa-file-pdf"></i>
                                    Cetak PDF
                                </a>

                                <a href="{{ asset('templates/template_aset_tanah.xlsx') }}" class="btn btn-secondary me-1"
                                    download><i class="fa fa-file-excel"></i>
                                    Unduh Template Excel
                                </a>
                            </div>
                        </div>
                    </div>

                    @if (isset($errors) && $errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif

                    @if (session()->has('failures'))
                        <div id="failures-alert" class="alert alert-warning" role="alert">
                            <div class="modal-header">
                                <h4 class="alert-heading">Gagal mengimpor beberapa data!</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Baris</th>
                                        <th>Attribute</th>
                                        <th>Error</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (session()->get('failures') as $failure)
                                        <tr>
                                            <td>{{ $failure->row() }}</td>
                                            <td>{{ $failure->attribute() }}</td>
                                            <td>
                                                <ul>
                                                    @foreach ($failure->errors() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ $failure->values()[$failure->attribute()] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="datatable"
                            class="table mb-0 border-0 table-bordered star-student table-hover table-center table-stripped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status Aset</th>
                                    <th>Kode</th>
                                    <th>Nama Tanah</th>
                                    <th>Tanggal Inventarisir</th>
                                    <th>Luas (m<sup>2</sup>)</th>
                                    <th>Letak Tanah</th>
                                    <th>Hak</th>
                                    <th>Tgl. Sertifikat</th>
                                    <th>No. Sertifikat</th>
                                    <th>Penggunaan</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
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

    <div id="import-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle" style="padding-left: 105px;">Import File Excel Aset Tanah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 mb-4 text-center">
                        <div class="auth-logo" style="margin-top: -20px;">
                            <a href="{{ route('dashboard') }}" class="logo logo-dark">
                                <span class="logo-lg">
                                    <img src="{{ url('assets/img/logo_lengkap_sip_aset.png') }}" alt=""
                                        height="60">
                                </span>
                            </a>
                        </div>
                    </div>

                    <form action="{{ route('tanah.importExcel') }}" method="POST" enctype="multipart/form-data"
                        class="px-3">
                        @csrf
                        <div class="mb-3" style="margin-top: -20px;">
                            <label class="form-label">Pilih File (harus berupa .xlsx)</label>
                            <input type="file" class="form-control" name="file"
                                placeholder="Masukkan file excel anda">

                            @error('file')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2 text-right">
                            <button class="btn btn-success" type="submit">Import Excel</button>
                        </div>
                    </form>
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
                ajax: "{{ route('tanah.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'status_aset',
                        name: 'status_aset'
                    },
                    {
                        data: 'kode_aset',
                        name: 'kode_aset'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'tanggal_inventarisir',
                        name: 'tanggal_inventarisir'
                    },
                    {
                        data: 'luas',
                        name: 'luas'
                    },
                    {
                        data: 'letak_tanah',
                        name: 'letak_tanah'
                    },
                    {
                        data: 'hak',
                        name: 'hak'
                    },
                    {
                        data: 'tanggal_sertifikat',
                        name: 'tanggal_sertifikat'
                    },
                    {
                        data: 'no_sertifikat',
                        name: 'no_sertifikat'
                    },
                    {
                        data: 'penggunaan',
                        name: 'penggunaan'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
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

        $('.cetak-excel').click(function(e) {
            e.preventDefault();

            Swal.fire({
                title: "Ingin mencetak Excel Aset Tanah?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Cetak!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna memilih Save, arahkan ke route ekspor Excel
                    window.location.href = "{{ route('tanah.exportExcel') }}";
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        });

        // Tunggu 5 detik setelah halaman dimuat
        setTimeout(function() {
            // Sembunyikan pesan kesalahan
            document.getElementById('failures-alert').style.display = 'none';
        }, 5000);

        // Sembunyikan pesan kesalahan ketika tombol close ditekan
        document.getElementById('failures-alert').addEventListener('closed.bs.alert', function() {
            this.style.display = 'none';
        });
    </script>
@endpush
