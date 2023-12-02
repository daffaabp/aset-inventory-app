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
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

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

                                <a href="{{ route('gedung.exportExcel') }}" class="btn btn-warning btn-md me-1"><i
                                        class="fas fa-file-export"></i>
                                    Cetak Excel
                                </a>

                                <a href="{{ route('gedung.exportPdf') }}" class="btn btn-danger btn-md me-1"
                                    target="_blank"><i class="fas fa-file-pdf"></i>
                                    Cetak PDF
                                </a>

                                <a href="{{ asset('templates/template_aset_gedung.xlsx') }}" class="btn btn-secondary me-1"
                                    download><i class="fa fa-file-excel"></i>
                                    Unduh Template Excel
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table
                            class="table mb-0 border-0 table-bordered star-student table-hover table-center datatable table-stripped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Kode Gedung</th>
                                    <th>Nama</th>
                                    <th>Tanggal Inventarisir</th>
                                    <th>Kondisi</th>
                                    <th>Bertingkat</th>
                                    <th>Beton</th>
                                    <th>Luas Lantai (m<sup>2</sup>)</th>
                                    <th>Lokasi</th>
                                    <th>Tahun Dokumen</th>
                                    <th>No Dokumen</th>
                                    <th>Luas Tanah (m<sup>2</sup>)</th>
                                    <th>Hak</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asetGedungs as $asetGedung)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $asetGedung->statusAset->status_aset }}</td>
                                        <td>{{ $asetGedung->kode_aset }}</td>
                                        <td>{{ $asetGedung->nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($asetGedung->tanggal_inventarisir)->isoFormat('D MMMM Y') }}
                                        </td>
                                        <td>{{ $asetGedung->kondisi }}</td>
                                        <td>{{ $asetGedung->bertingkat }}</td>
                                        <td>{{ $asetGedung->beton }}</td>
                                        <td>{{ $asetGedung->luas_lantai }}</td>
                                        <td>{{ $asetGedung->lokasi }}</td>
                                        <td>{{ $asetGedung->tahun_dok }}</td>
                                        <td>{{ $asetGedung->nomor_dok }}</td>
                                        <td>{{ $asetGedung->luas }}</td>
                                        <td>{{ $asetGedung->hak }}</td>
                                        <td>{{ formatRupiah($asetGedung->harga, true) }}</td>
                                        <td>{{ $asetGedung->keterangan }}</td>
                                        <td>
                                            <form action="{{ route('gedung.destroy', $asetGedung->id_aset_gedung) }}"
                                                method="POST">

                                                <a class="btn btn-primary me-2" style="color: white;"
                                                    href="{{ route('gedung.edit', $asetGedung->id_aset_gedung) }}">Edit</a>

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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
@endsection

@push('js')
    <script>
        // Tunggu 5 detik setelah halaman dimuat
        setTimeout(function() {
            // Sembunyikan pesan kesalahan
            document.getElementById('failures-alert').style.display = 'none';
        }, 10000);

        // Sembunyikan pesan kesalahan ketika tombol close ditekan
        document.getElementById('failures-alert').addEventListener('closed.bs.alert', function() {
            this.style.display = 'none';
        });

        window.onload = function() {
            alert("Gagal mengimpor data. Silakan periksa file Anda.");
        };
    </script>
@endpush
