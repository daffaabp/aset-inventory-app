@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Aset Kendaraan</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Aset Kendaraan</li>
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
                                <a href="{{ route('kendaraan.create') }}" class="btn btn-outline-primary me-2"><i
                                        class="fas fa-plus"></i></i>
                                    Tambah Aset</a>

                                <button type="button" class="btn btn-success btn-md me-1" data-bs-toggle="modal"
                                    data-bs-target="#import-modal" data-class="import-excel"><i
                                        class="fas fa-file-import"></i>
                                    Import Excel</button>

                                <a href="#" class="btn btn-warning btn-md me-1 cetak-excel"><i
                                        class="fas fa-file-export"></i> Cetak Excel</a>

                                <button type="button" class="btn btn-danger btn-md me-1" data-bs-toggle="modal"
                                    data-bs-target="#export-pdf" data-class="export-pdf"><i class="fas fa-file-import"></i>
                                    Cetak PDF</button>

                                <a href="{{ asset('templates/template_aset_kendaraan.xlsx') }}"
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
                                    <th>Nama Kendaraan</th>
                                    <th>Tanggal Inventarisir</th>
                                    <th>Merk</th>
                                    <th>Type</th>
                                    <th>Cylinder</th>
                                    <th>Warna</th>
                                    <th>No. Rangka</th>
                                    <th>No. Mesin</th>
                                    <th>Thn Pembuatan</th>
                                    <th>Thn Pembelian</th>
                                    <th>No. Polisi</th>
                                    <th>Tgl. BPKB</th>
                                    <th>No. BPKB</th>
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
                    <h5 class="modal-title" id="modalTitle" style="padding-left: 82px;">Import File Excel Aset Kendaraan
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

                    <form action="{{ route('kendaraan.importExcel') }}" method="POST" enctype="multipart/form-data"
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
                    <h5 class="modal-title" id="modalTitle">Cetak Laporan Aset Kendaraan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kendaraan.exportPdf') }}" method="GET" enctype="multipart/form-data"
                        class="px-3" id="export-pdf-form">
                        @csrf
                        <div class="form-group">
                            <label>Pilih Opsi</label>
                            <select id="opsi" class="form-control form-select" name="opsi" autocomplete="off"
                                autofocus>
                                <option value="Semua Data">Semua Data</option>
                                <option value="Berdasarkan Status Aset">Berdasarkan Status Aset</option>
                                <option value="Berdasarkan Nama Kendaraan">Berdasarkan Nama Kendaraan</option>
                                <option value="Berdasarkan Tahun Pembuatan">Berdasarkan Tahun Pembuatan</option>
                                <option value="Berdasarkan Tahun Pembelian">Berdasarkan Tahun Pembelian</option>
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

                        <!-- Tambahkan div untuk menyimpan dropdown nama kendaraan -->
                        <div id="namaKendaraanDropdown" class="form-group" style="display: none;">
                            <label class="form-label">Pilih Nama Kendaraan</label>
                            <select class="form-control" name="nama">
                                @foreach ($asetKendaraans->unique('nama')->sortBy('nama') as $row)
                                    <option value="{{ $row->nama }}">{{ $row->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tambahkan div untuk menyimpan dropdown tahun pembuatan -->
                        <div id="tahunPembuatanDropdown" class="form-group" style="display: none;">
                            <label class="form-label">Pilih Tahun Pembuatan</label>
                            {{-- <input type="number" class="form-control" name="thn_pembuatan"
                                placeholder="Masukkan Tahun Perolehan"> --}}
                            <select class="form-control" name="thn_pembuatan">
                                @foreach ($asetKendaraans->unique('thn_pembuatan') as $row)
                                    <option value="{{ $row->thn_pembuatan }}">{{ $row->thn_pembuatan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tambahkan div untuk menyimpan dropdown tahun pembelian -->
                        <div id="tahunPembelianDropdown" class="form-group" style="display: none;">
                            <label class="form-label">Pilih Tahun Pembelian</label>
                            {{-- <input type="number" class="form-control" name="thn_pembelian"
                                placeholder="Masukkan Tahun Pembelian"> --}}
                            <select class="form-control" name="thn_pembelian">
                                @foreach ($asetKendaraans->unique('thn_pembelian')->sortByDesc('thn_pembuatan') as $row)
                                    <option value="{{ $row->thn_pembelian }}">{{ $row->thn_pembelian }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Kustom --}}
                        <!-- Tambahkan div untuk menyimpan dropdown status -->
                        <div id="statusDropdown2" class="form-group" style="display: none;">
                            <label class="form-label">Pilih Status Aset <span style="color: red;">*</span></label>
                            <select class="form-control" name="status_aset2">
                                <option value="">-- Pilih Status Aset --</option>
                                @if ($asetKendaraans->isNotEmpty())
                                    @foreach ($statusAset as $row)
                                        <option value="{{ $row->id_status_aset }}">{{ $row->status_aset }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Tambahkan div untuk menyimpan dropdown nama kendaraan -->
                        <div id="namaKendaraanDropdown2" class="form-group" style="display: none;">
                            <label class="form-label">Pilih Nama Kendaraan <span style="color: red;">*</span></label>
                            <select class="form-control" name="nama2">
                                <option value="">-- Pilih Nama Kendaraan --</option>
                                @if ($asetKendaraans->isNotEmpty())
                                    @foreach ($asetKendaraans->sortBy('nama')->unique('nama') as $row)
                                        <option value="{{ $row->nama }}">{{ $row->nama }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Tambahkan div untuk menyimpan dropdown tahun pembuatan -->
                        <div id="tahunPembuatanDropdown2" class="form-group" style="display: none;">
                            <label class="form-label">Pilih Tahun Pembuatan <span style="color: red;">*</span></label>
                            <select class="form-control" name="thn_pembuatan2">
                                <option value="">-- Pilih Tahun Pembuatan --</option>
                                @if ($asetKendaraans->isNotEmpty())
                                    @foreach ($asetKendaraans->unique('thn_pembuatan') as $row)
                                        <option value="{{ $row->thn_pembuatan }}">{{ $row->thn_pembuatan }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Tambahkan div untuk menyimpan dropdown tahun pembelian -->
                        <div id="tahunPembelianDropdown2" class="form-group" style="display: none;">
                            <label class="form-label">-- Pilih Tahun Pembelian -- <span
                                    style="color: red;">*</span></label>
                            <select class="form-control" name="thn_pembelian2">
                                <option value="">-- Pilih Tahun Pembelian --</option>
                                @if ($asetKendaraans->isNotEmpty())
                                    @foreach ($asetKendaraans->unique('thn_pembelian')->sortByDesc('thn_pembuatan') as $row)
                                        <option value="{{ $row->thn_pembelian }}">{{ $row->thn_pembelian }}</option>
                                    @endforeach
                                @endif
                            </select>
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
                ajax: "{{ route('kendaraan.index') }}",
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
                        data: 'merk',
                        name: 'merk'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'cylinder',
                        name: 'cylinder'
                    },
                    {
                        data: 'warna',
                        name: 'warna'
                    },
                    {
                        data: 'no_rangka',
                        name: 'no_rangka'
                    },
                    {
                        data: 'no_mesin',
                        name: 'no_mesin'
                    },
                    {
                        data: 'thn_pembuatan',
                        name: 'thn_pembuatan'
                    },
                    {
                        data: 'thn_pembelian',
                        name: 'thn_pembelian'
                    },
                    {
                        data: 'no_polisi',
                        name: 'no_polisi'
                    },
                    {
                        data: 'tgl_bpkb',
                        name: 'tgl_bpkb'
                    },
                    {
                        data: 'no_bpkb',
                        name: 'no_bpkb'
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
                title: "Ingin mencetak Excel Aset Kendaraan?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Cetak!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna memilih Save, arahkan ke route ekspor Excel
                    window.location.href = "{{ route('kendaraan.exportExcel') }}";
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
            var namaKendaraanDropdown = document.getElementById('namaKendaraanDropdown');
            var tahunPembuatanDropdown = document.getElementById('tahunPembuatanDropdown');
            var tahunPembelianDropdown = document.getElementById('tahunPembelianDropdown');

            var statusDropdown2 = document.getElementById('statusDropdown2');
            var namaKendaraanDropdown2 = document.getElementById('namaKendaraanDropdown2');
            var tahunPembuatanDropdown2 = document.getElementById('tahunPembuatanDropdown2');
            var tahunPembelianDropdown2 = document.getElementById('tahunPembelianDropdown2');

            if (this.value === 'Berdasarkan Status Aset') {
                statusDropdown.style.display = 'block';
                namaKendaraanDropdown.style.display = 'none';
                tahunPembuatanDropdown.style.display = 'none';
                tahunPembelianDropdown.style.display = 'none';

                statusDropdown2.style.display = 'none';
                namaKendaraanDropdown2.style.display = 'none';
                tahunPembuatanDropdown2.style.display = 'none';
                tahunPembelianDropdown2.style.display = 'none';

            } else if (this.value === 'Berdasarkan Nama Kendaraan') {
                statusDropdown.style.display = 'none';
                namaKendaraanDropdown.style.display = 'block';
                tahunPembuatanDropdown.style.display = 'none';
                tahunPembelianDropdown.style.display = 'none';

                statusDropdown2.style.display = 'none';
                namaKendaraanDropdown2.style.display = 'none';
                tahunPembuatanDropdown2.style.display = 'none';
                tahunPembelianDropdown2.style.display = 'none';

            } else if (this.value === 'Berdasarkan Tahun Pembuatan') {
                statusDropdown.style.display = 'none';
                namaKendaraanDropdown.style.display = 'none';
                tahunPembuatanDropdown.style.display = 'block';
                tahunPembelianDropdown.style.display = 'none';

                statusDropdown2.style.display = 'none';
                namaKendaraanDropdown2.style.display = 'none';
                tahunPembuatanDropdown2.style.display = 'none';
                tahunPembelianDropdown2.style.display = 'none';

            } else if (this.value === 'Berdasarkan Tahun Pembelian') {
                statusDropdown.style.display = 'none';
                namaKendaraanDropdown.style.display = 'none';
                tahunPembuatanDropdown.style.display = 'none';
                tahunPembelianDropdown.style.display = 'block';

                statusDropdown2.style.display = 'none';
                namaKendaraanDropdown2.style.display = 'none';
                tahunPembuatanDropdown2.style.display = 'none';
                tahunPembelianDropdown2.style.display = 'none';

            } else if (this.value === 'Berdasarkan Kustom') {
                statusDropdown.style.display = 'none';
                namaKendaraanDropdown.style.display = 'none';
                tahunPembuatanDropdown.style.display = 'none';
                tahunPembelianDropdown.style.display = 'none';

                statusDropdown2.style.display = 'block';
                namaKendaraanDropdown2.style.display = 'block';
                tahunPembuatanDropdown2.style.display = 'block';
                tahunPembelianDropdown2.style.display = 'block';

            } else {
                statusDropdown.style.display = 'none';
                namaKendaraanDropdown.style.display = 'none';
                tahunPembuatanDropdown.style.display = 'none';
                tahunPembelianDropdown.style.display = 'none';
                statusDropdown2.style.display = 'none';
                namaKendaraanDropdown2.style.display = 'none';
                tahunPembuatanDropdown2.style.display = 'none';
                tahunPembelianDropdown2.style.display = 'none';
            }
        });
    </script>
@endpush
