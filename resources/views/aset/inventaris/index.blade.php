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

                                <a href="{{ route('inventaris.exportExcel') }}" class="btn btn-warning btn-md me-1"><i
                                        class="fas fa-file-export"></i>
                                    Export Excel
                                </a>

                                <a href="{{ route('inventaris.exportPdf') }}" class="btn btn-danger btn-md me-1"
                                    target="_blank"><i class="fas fa-file-pdf"></i>
                                    Export PDF
                                </a>

                                <a href="{{ asset('templates/template_aset_inventaris_ruangan.xlsx') }}"
                                    class="btn btn-secondary me-1" download><i class="fa fa-file-excel"></i>
                                    Unduh Template Excel
                                </a>
                            </div>
                        </div>
                    </div>

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

                    <div class="table-responsive">
                        <table
                            class="table mb-0 border-0 table-bordered star-student table-hover table-center datatable table-stripped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Kode</th>
                                    <th>Ruangan</th>
                                    <th>Nama</th>
                                    <th>Tanggal Inventarisir</th>
                                    <th>Merk</th>
                                    <th>Volume</th>
                                    <th>Bahan</th>
                                    <th>Tahun</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asetInventaris as $inventaris)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $inventaris->statusAset->status_aset }}</td>
                                        <td>{{ $inventaris->kode_aset }}</td>
                                        <td>{{ $inventaris->ruangan->nama }}</td>
                                        <td>{{ $inventaris->nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($inventaris->tanggal_inventarisir)->isoFormat('D MMMM Y') }}
                                        </td>
                                        <td>{{ $inventaris->merk }}</td>
                                        <td>{{ $inventaris->volume }}</td>
                                        <td>{{ $inventaris->bahan }}</td>
                                        <td>{{ $inventaris->tahun }}</td>
                                        <td>{{ formatRupiah($inventaris->harga, true) }}</td>
                                        <td>{{ $inventaris->keterangan }}</td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="{{ route('inventaris.edit', $inventaris->id_aset_inventaris_ruangan) }}"
                                                    class="btn btn-sm bg-success-light me-2">
                                                    <i class="feather-edit"></i>
                                                </a>

                                                <a href="javascript:;" class="btn btn-sm bg-danger-light"
                                                    onclick="confirmDelete('{{ route('inventaris.destroy', $inventaris->id_aset_inventaris_ruangan) }}')">
                                                    <i class="feather-trash"></i>
                                                </a>

                                                <form id="deleteForm" action="" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
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

        function confirmDelete(url) {
            if (confirm('Apakah Anda yakin ingin menghapus?')) {
                var form = document.getElementById('deleteForm');
                form.action = url;
                form.submit();
            }
        }
    </script>
@endpush
