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
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="{{ route('inventaris.create') }}" class="btn btn-outline-primary me-2"><i
                                        class="fas fa-plus"></i></i>
                                    Tambah Aset</a>

                                <a href="{{ route('inventaris.createMassal') }}" class="btn btn-info btn-outline-info me-2"
                                    style="color: white"><i class="fas fa-plus"></i></i>
                                    Tambah Aset Massal</a>

                                <a href="{{ route('inventaris.indexMassal') }}" class="btn btn-dark btn-outline-dark me-2"
                                    style="color: white"><i class="fas fa-minus"></i></i>
                                    Hapus Massal Aset</a>

                                <button type="button" class="btn btn-success btn-md me-1" data-bs-toggle="modal"
                                    data-bs-target="#import-modal" data-class="import-excel"><i
                                        class="fas fa-file-import"></i>
                                    Import Excel</button>

                                <a href="#" class="btn btn-warning btn-md me-1 cetak-excel"><i
                                        class="fas fa-file-export"></i> Cetak Excel</a>

                                <button type="button" class="btn btn-danger btn-md me-1" data-bs-toggle="modal"
                                    data-bs-target="#export-pdf" data-class="export-pdf"><i class="fas fa-file-import"></i>
                                    Cetak PDF</button>

                                <a href="{{ asset('templates/template_aset_inventaris_ruangan.xlsx') }}"
                                    class="btn btn-secondary me-1" download><i class="fa fa-file-excel"></i>
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

                    <div class="table-responsive">
                        <table id="datatable"
                            class="table mb-0 border-0 table-bordered star-student table-hover table-center table-stripped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status Aset</th>
                                    <th>Ruangan</th>
                                    <th>Kode</th>
                                    <th>Nama Inventaris</th>
                                    <th>Bahan</th>
                                    <th>Tahun</th>
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
                    <h5 class="modal-title" id="modalTitle" style="padding-left: 30px;">Import File Excel Aset Inventaris
                        Ruangan
                    </h5>
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

                    <form action="{{ route('inventaris.importExcel') }}" method="POST" enctype="multipart/form-data"
                        class="px-3">
                        @csrf
                        <div class="mb-3" style="margin-top: -20px;">
                            <label class="form-label">Pilih File (harus berupa .xlsx)</label>
                            <input type="file" class="form-control" name="file" accept=".xlsx, .xls"
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

    <div id="export-pdf" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Cetak Laporan Aset Inventaris
                        Ruangan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('inventaris.exportPdf') }}" method="GET" enctype="multipart/form-data"
                        class="px-3" id="export-pdf-form">
                        @csrf
                        <div class="form-group">
                            <label>Pilih Opsi</label>
                            <select id="opsi" class="form-control form-select" name="opsi" autocomplete="off"
                                autofocus>
                                <option value="Semua Data">Semua Data</option>
                                <option value="Data Tahun Ini">Data Tahun Ini</option>
                                <option value="Berdasarkan Ruang">Berdasarkan Ruangan</option>
                                <option value="Berdasarkan Tahun Perolehan">Berdasarkan Tahun Perolehan</option>
                            </select>
                        </div>

                        <!-- Tambahkan div untuk menyimpan dropdown ruangan -->
                        <div id="ruanganDropdown" class="form-group" style="display: none;">
                            <label class="form-label">Pilih Ruangan</label>
                            <select class="form-control" name="ruangan_id">
                                @foreach ($daftarRuangan as $ruangan)
                                    <option value="{{ $ruangan->kode_ruangan }}">{{ $ruangan->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tambahkan div untuk menyimpan input tahun -->
                        <div id="tahunDropdown" class="form-group  @error('tahun_perolehan') is-invalid @enderror"
                            style="display: none;">
                            <label class="form-label">Tahun Perolehan</label>
                            <input type="number" class="form-control" name="tahun_perolehan"
                                placeholder="Masukkan Tahun Perolehan">
                            @error('tahun_perolehan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tambahkan div untuk menyimpan input tahun -->
                        <div id="tahunDropdown2" class="form-group  @error('tahun_perolehan2') is-invalid @enderror"
                            style="display: none;">
                            <label class="form-label">Tahun Perolehan (opsional jika diperlukan<span
                                    style="color: red;">*</span> )</label>
                            <input type="number" class="form-control" name="tahun_perolehan2"
                                placeholder="Masukkan Tahun Perolehan">
                            @error('tahun_perolehan2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2 text-right">
                            <button class="btn btn-success" type="submit">Export PDF</button>
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
                ajax: "{{ route('inventaris.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'status_aset',
                        name: 'status_aset'
                    },
                    {
                        data: 'ruangan',
                        name: 'ruangan'
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
                        data: 'bahan',
                        name: 'bahan'
                    },
                    {
                        data: 'tahun',
                        name: 'tahun'
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
        @endif

        $('.cetak-excel').click(function(e) {
            e.preventDefault();

            Swal.fire({
                title: "Ingin mencetak Excel Aset Inventaris?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Cetak!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna memilih Save, arahkan ke route ekspor Excel
                    window.location.href = "{{ route('inventaris.exportExcel') }}";
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        });

        // Tunggu 5 detik setelah halaman dimuat
        setTimeout(function() {
            // Sembunyikan pesan kesalahan
            document.getElementById('failures-alert').style.display = 'none';
        }, 10000);

        // Sembunyikan pesan kesalahan ketika tombol close ditekan
        document.getElementById('failures-alert').addEventListener('closed.bs.alert', function() {
            this.style.display = 'none';
        });
    </script>

    <script>
        // Tampilkan atau sembunyikan dropdown berdasarkan opsi yang dipilih
        document.getElementById('opsi').addEventListener('change', function() {
            var ruanganDropdown = document.getElementById('ruanganDropdown');
            var tahunDropdown = document.getElementById('tahunDropdown');
            var tahunDropdown2 = document.getElementById('tahunDropdown2');

            if (this.value === 'Berdasarkan Ruang') {
                ruanganDropdown.style.display = 'block';
                tahunDropdown.style.display = 'none';
                tahunDropdown2.style.display = 'block';
            } else if (this.value === 'Berdasarkan Tahun Perolehan') {
                ruanganDropdown.style.display = 'none';
                tahunDropdown.style.display = 'block';
                tahunDropdown2.style.display = 'none';
            } else {
                ruanganDropdown.style.display = 'none';
                tahunDropdown.style.display = 'none';
                tahunDropdown2.style.display = 'none';
            }
        });
    </script>
@endpush
