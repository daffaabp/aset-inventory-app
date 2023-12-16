@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Aset Gedung</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Aset Gedung</li>
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
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="{{ route('gedung.create') }}" class="btn btn-outline-primary me-2"><i
                                        class="fas fa-plus"></i></i>
                                    Tambah Aset</a>

                                <button type="button" class="btn btn-success btn-md me-1" data-bs-toggle="modal"
                                    data-bs-target="#import-modal" data-class="import-excel"><i
                                        class="fas fa-file-import"></i> Import Excel</button>

                                <a href="#" class="btn btn-warning btn-md me-1 cetak-excel"><i
                                        class="fas fa-file-export"></i> Cetak Excel</a>

                                <button type="button" class="btn btn-danger btn-md me-1" data-bs-toggle="modal"
                                    data-bs-target="#export-pdf" data-class="export-pdf"><i class="fas fa-file-import"></i>
                                    Cetak PDF</button>

                                <a href="{{ asset('templates/template_aset_gedung.xlsx') }}" class="btn btn-secondary me-1"
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
                                    <th>Nama Gedung</th>
                                    <th>Kondisi</th>
                                    <th>Lokasi</th>
                                    <th>Luas Tanah (m<sup>2</sup>)</th>
                                    <th>Bertingkat</th>
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
                    <h5 class="modal-title" id="modalTitle" style="padding-left: 160px;">Import File Excel</h5>
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

                    <form action="{{ route('gedung.importExcel') }}" method="POST" enctype="multipart/form-data"
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

    <div id="export-pdf" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Cetak Laporan Aset Gedung
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('gedung.exportPdf') }}" method="GET" enctype="multipart/form-data"
                        class="px-3" id="export-pdf-form">
                        @csrf
                        <div class="form-group">
                            <label>Pilih Opsi</label>
                            <select id="opsi" class="form-control form-select" name="opsi" autocomplete="off"
                                autofocus>
                                <option value="Semua Data">Semua Data</option>
                                <option value="Berdasarkan Status Aset">Berdasarkan Status Aset</option>
                                <option value="Berdasarkan Kondisi">Berdasarkan Kondisi</option>
                                <option value="Berdasarkan Hak">Berdasarkan Hak</option>
                                <option value="Berdasarkan Tahun Dokumen">Berdasarkan Tahun Dokumen</option>
                                <option value="Berdasarkan Kustom">Berdasarkan Kustom</option>

                            </select>
                        </div>

                        <!-- Tambahkan div untuk menyimpan dropdown status -->
                        <div id="statusDropdown" class="form-group" style="display: none;">
                            <label class="form-label">Pilih Status Aset</label>
                            <select class="form-control" name="status_aset">
                                @foreach ($statusAset as $row)
                                    <option value="{{ $row->id_status_aset }}">{{ $row->status_aset }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tambahkan div untuk menyimpan dropdown kondisi -->
                        <div id="kondisiDropdown" class="form-group" style="display: none;">
                            <label class="form-label">Pilih Kondisi</label>
                            <select class="form-control" name="kondisi">
                                <option value="Baik">
                                    Baik
                                </option>
                                <option value="Rusak">
                                    Rusak
                                </option>
                                <option value="Korosi">
                                    Korosi
                                </option>
                                <option value="Baru">
                                    Baru
                                </option>
                            </select>
                        </div>

                        <!-- Tambahkan div untuk menyimpan dropdown kondisi -->
                        <div id="hakDropdown" class="form-group" style="display: none;">
                            <label class="form-label">Pilih Hak</label>
                            <select class="form-control" name="hak">
                                <option value="HGB">
                                    HGB
                                </option>
                                <option value="Milik">
                                    Milik
                                </option>
                            </select>
                        </div>

                        <!-- Tambahkan div untuk menyimpan input tahun dokumen-->
                        <div id="tahunDokumenDropdown" class="form-group" style="display: none;">
                            <label class="form-label">Tahun Perolehan</label>
                            <input type="number" class="form-control" name="tahun_dok"
                                placeholder="Masukkan Tahun Dokumen">
                        </div>

                        <!-- Tambahkan div untuk menyimpan dropdown status -->
                        <div id="statusDropdown2" class="form-group" style="display: none;">
                            <label class="form-label">Pilih Status Aset <span style="color: red;">*</span></label>
                            <select class="form-control" name="status_aset2">
                                <option value="">-- Pilih Status Aset --</option>
                                @foreach ($statusAset as $row)
                                    <option value="{{ $row->id_status_aset }}">{{ $row->status_aset }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tambahkan div untuk menyimpan dropdown kondisi -->
                        <div id="kondisiDropdown2" class="form-group" style="display: none;">
                            <label class="form-label">Pilih Kondisi <span style="color: red;">*</span></label>
                            <select class="form-control" name="kondisi2">
                                <option value="">-- Pilih Kondisi --</option>
                                @if ($asetGedungs->isNotEmpty())
                                    @foreach ($asetGedungs->sortBy('kondisi')->unique('kondisi') as $row)
                                        <option value="{{ $row->kondisi }}">{{ $row->kondisi }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Tambahkan div untuk menyimpan dropdown kondisi -->
                        <div id="hakDropdown2" class="form-group" style="display: none;">
                            <label class="form-label">Pilih Hak</label>
                            <select class="form-control" name="hak2">
                                <option value="">-- Pilih Hak --</option>
                                @if ($asetGedungs->isNotEmpty())
                                    @foreach ($asetGedungs->sortBy('hak')->unique('hak') as $row)
                                        <option value="{{ $row->hak }}">{{ $row->hak }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Tambahkan div untuk menyimpan input tahun dokumen-->
                        <div id="tahunDokumenDropdown2" class="form-group" style="display: none;">
                            <label class="form-label">Tahun Perolehan <span style="color: red;">*</span></label>
                            <input type="number" class="form-control" name="tahun_dok2"
                                placeholder="Masukkan Tahun Dokumen">
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
                ajax: "{{ route('gedung.index') }}",
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
                        data: 'kondisi',
                        name: 'kondisi'
                    },
                    {
                        data: 'lokasi',
                        name: 'lokasi'
                    },
                    {
                        data: 'luas',
                        name: 'luas'
                    },
                    {
                        data: 'bertingkat',
                        name: 'bertingkat'
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
                title: "Ingin mencetak Excel Aset Gedung?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Cetak!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna memilih Save, arahkan ke route ekspor Excel
                    window.location.href = "{{ route('gedung.exportExcel') }}";
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

    <script>
        // Tampilkan atau sembunyikan dropdown berdasarkan opsi yang dipilih
        document.getElementById('opsi').addEventListener('change', function() {
            var statusDropdown = document.getElementById('statusDropdown');
            var kondisiDropdown = document.getElementById('kondisiDropdown');
            var hakDropdown = document.getElementById('hakDropdown');
            var tahunDokumenDropdown = document.getElementById('tahunDokumenDropdown');

            var statusDropdown2 = document.getElementById('statusDropdown2');
            var kondisiDropdown2 = document.getElementById('kondisiDropdown2');
            var hakDropdown2 = document.getElementById('hakDropdown2');
            var tahunDokumenDropdown2 = document.getElementById('tahunDokumenDropdown2');

            if (this.value === 'Berdasarkan Status Aset') {
                statusDropdown.style.display = 'block';
                kondisiDropdown.style.display = 'none';
                hakDropdown.style.display = 'none';
                tahunDokumenDropdown.style.display = 'none';

                statusDropdown2.style.display = 'none';
                kondisiDropdown2.style.display = 'none';
                hakDropdown2.style.display = 'none';
                tahunDokumenDropdown2.style.display = 'none';

            } else if (this.value === 'Berdasarkan Kondisi') {
                statusDropdown.style.display = 'none';
                kondisiDropdown.style.display = 'block';
                hakDropdown.style.display = 'none';
                tahunDokumenDropdown.style.display = 'none';

                statusDropdown2.style.display = 'none';
                kondisiDropdown2.style.display = 'none';
                hakDropdown2.style.display = 'none';
                tahunDokumenDropdown2.style.display = 'none';

            } else if (this.value === 'Berdasarkan Hak') {
                statusDropdown.style.display = 'none';
                kondisiDropdown.style.display = 'none';
                hakDropdown.style.display = 'block';
                tahunDokumenDropdown.style.display = 'none';

                statusDropdown2.style.display = 'none';
                kondisiDropdown2.style.display = 'none';
                hakDropdown2.style.display = 'none';
                tahunDokumenDropdown2.style.display = 'none';

            } else if (this.value === 'Berdasarkan Tahun Dokumen') {
                statusDropdown.style.display = 'none';
                kondisiDropdown.style.display = 'none';
                hakDropdown.style.display = 'none';
                tahunDokumenDropdown.style.display = 'block';

                statusDropdown2.style.display = 'none';
                kondisiDropdown2.style.display = 'none';
                hakDropdown2.style.display = 'none';
                tahunDokumenDropdown2.style.display = 'none';

            } else if (this.value === 'Berdasarkan Kustom') {
                statusDropdown.style.display = 'none';
                kondisiDropdown.style.display = 'none';
                hakDropdown.style.display = 'none';
                tahunDokumenDropdown.style.display = 'none';

                statusDropdown2.style.display = 'block';
                kondisiDropdown2.style.display = 'block';
                hakDropdown2.style.display = 'block';
                tahunDokumenDropdown2.style.display = 'block';

            } else {
                statusDropdown.style.display = 'none';
                kondisiDropdown.style.display = 'none';
                hakDropdown2.style.display = 'none';
                tahunDokumenDropdown.style.display = 'none';

                statusDropdown2.style.display = 'none';
                kondisiDropdown2.style.display = 'none';
                hakDropdown2.style.display = 'none';
                tahunDokumenDropdown2.style.display = 'none';
            }
        });
    </script>
@endpush
