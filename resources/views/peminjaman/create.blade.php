@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tambah Peminjaman</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tambah Peminjaman</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('peminjaman.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group local-forms">
                                    <label>Detail Kegunaan Pinjam <span class="login-danger">*</span></label>
                                    <input type="text" name="kegunaan" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="form-group local-forms">
                                    <label>Tgl Rencana Pinjam <span class="login-danger">*</span></label>
                                    <input type="date" name="tgl_rencana_pinjam" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="form-group local-forms">
                                    <label>Tgl Rencana Kembali <span class="login-danger">*</span></label>
                                    <input type="date" name="tgl_rencana_kembali" class="form-control">
                                </div>
                            </div>

                            {{-- Accordion Tab --}}
                            <div class="card-body" style="margin-top: -40px;">
                                <h5 class="mb-4 header-title">Daftar Aset Yang Dipinjam</h5>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="#aset_tanah" data-bs-toggle="tab" aria-expanded="true"
                                            class="nav-link active">
                                            Aset Tanah
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#aset_gedung" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                            Aset Gedung
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#aset_kendaraan" data-bs-toggle="tab" aria-expanded="true"
                                            class="nav-link">
                                            Aset Kendaraan
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#aset_inventaris_ruangan" data-bs-toggle="tab" aria-expanded="true"
                                            class="nav-link">
                                            Aset Inventaris Ruangan
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    {{-- Tab Pane Aset Tanah --}}
                                    <div class="tab-pane show active" id="aset_tanah">
                                        <div class="col-lg-2">
                                            <button type="button" class="mt-1 btn btn-info btn-modal-load"
                                                data-aset="tanah" data-bs-toggle="modal"
                                                data-bs-target="#bs-example-modal-lg">Tambah</button>
                                        </div><br>
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Kode Aset</th>
                                                        <th scope="col">Nama Tanah</th>
                                                        <th scope="col">Lokasi Tanah</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="asetTanahTerpilih">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- Tab Pane Aset Gedung --}}
                                    <div class="tab-pane show" id="aset_gedung">
                                        <div class="col-lg-2">
                                            <button type="button" class="mt-1 btn btn-info btn-modal-load"
                                                data-aset="gedung" data-bs-toggle="modal"
                                                data-bs-target="#bs-example-modal-lg">Tambah</button>
                                        </div><br>
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Kode Aset</th>
                                                        <th scope="col">Nama Gedung</th>
                                                        <th scope="col">Lokasi Gedung</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="asetGedungTerpilih">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- Tab Pane Aset Kendaraan --}}
                                    <div class="tab-pane show" id="aset_kendaraan">
                                        <div class="col-lg-2">
                                            <button type="button" class="mt-1 btn btn-info btn-modal-load"
                                                data-aset="kendaraan" data-bs-toggle="modal"
                                                data-bs-target="#bs-example-modal-lg">Tambah</button>
                                        </div><br>
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Kode Aset</th>
                                                        <th scope="col">Nama Kendaraan</th>
                                                        <th scope="col">Merk</th>
                                                        <th scope="col">Warna</th>
                                                        <th scope="col">No Polisi</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="asetKendaraanTerpilih">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- Tab Pane Aset Inventaris Ruangan --}}
                                    <div class="tab-pane show" id="aset_inventaris_ruangan">
                                        <div class="col-lg-2">
                                            <button type="button" class="mt-1 btn btn-info btn-modal-load"
                                                data-aset="inventaris_ruangan" data-bs-toggle="modal"
                                                data-bs-target="#bs-example-modal-lg">Tambah</button>
                                        </div><br>
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Kode Aset</th>
                                                        <th scope="col">Nama Inventaris Ruangan</th>
                                                        <th scope="col">Merk</th>
                                                        <th scope="col">Bahan</th>
                                                        <th scope="col">Jumlah</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="asetInventarisRuanganTerpilih">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12" style="margin-left: 575px;">
                                <div class="student-submit">
                                    <button type="submit" class="btn btn-primary">Buat Peminjaman</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Daftar Aset</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="asetFormModel">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="jenis" id="asetFormModel-jenis">
                        <div class="table-responsive" id="asetListModal">

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="asetBtnModal" class="btn btn-primary">Tambah</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Membuat objek untuk melacak aset yang telah dipilih
            let asetTerpilih = {};
            $(".btn-modal-load").on('click', function() {
                let e = $(this);
                $.ajax({
                    url: "{{ route('getAset') }}",
                    type: "GET",
                    data: {
                        '_token': '{{ csrf_token() }}', // Tambahkan token CSRF di sini
                        'jenis': e.data('aset')
                    },
                    success: function(data) {

                        $("#asetFormModel-jenis").val(e.data('aset'));
                        // Hapus semua aset yang telah dipilih sebelumnya dari modal
                        $('#asetListModal').html(data);

                        // Sembunyikan atau hapus aset yang telah dipilih
                        for (let asetId in asetTerpilih) {
                            $(`#asetListModal input[value="${asetId}"]`).closest('tr').remove();
                        }

                    },
                });
            });

            $("#asetFormModel").on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serializeArray();
                $.ajax({
                    url: "{{ route('addAset') }}",
                    type: "POST",
                    data: formData,
                    success: function(res) {
                        let data = res.data;
                        let jenis = res.jenis_aset;

                        for (let i = 0; i < data.length; i++) {
                            let tableRow = '';
                            if (jenis === 'tanah') {
                                const asetId = data[i].id_aset_tanah;
                                if (!asetTerpilih.hasOwnProperty(asetId)) {
                                    asetTerpilih[asetId] = true;
                                    let tableRow = `
                                    <tr>
                                        <td>${data[i].kode_aset}</td>
                                        <td>${data[i].nama}</td>
                                        <td>${data[i].letak_tanah}</td>
                                        <td>${data[i].status_aset}</td>
                                        <input type="hidden" name="aset_tanah[]" value="${data[i].id_aset_tanah}">
                                    </tr>
                                        `;
                                    $('#asetTanahTerpilih').append(tableRow);
                                }
                                // Hapus aset yang telah dipilih dari modal
                                $(`#asetListModal input[value="${asetId}"]`).closest(
                                    'tr').remove()

                            } else if (jenis === 'gedung') {
                                const asetId = data[i].id_aset_gedung;
                                if (!asetTerpilih.hasOwnProperty(asetId)) {
                                    asetTerpilih[asetId] = true;
                                    let tableRow = `
                                    <tr>
                                        <td>${data[i].kode_aset}</td>
                                        <td>${data[i].nama}</td>
                                        <td>${data[i].lokasi}</td>
                                        <td>${data[i].status_aset}</td>
                                        <input type="hidden" name="aset_gedung[]" value="${data[i].id_aset_gedung}">
                                    </tr>
                                        `;
                                    $('#asetGedungTerpilih').append(tableRow);
                                }
                                // Hapus aset yang telah dipilih dari modal
                                $(`#asetListModal input[value="${asetId}"]`).closest(
                                    'tr').remove()

                            } else if (jenis === 'kendaraan') {
                                const asetId = data[i].id_aset_kendaraan;
                                if (!asetTerpilih.hasOwnProperty(asetId)) {
                                    asetTerpilih[asetId] = true;
                                    let tableRow = `
                                    <tr>
                                        <td>${data[i].kode_aset}</td>
                                        <td>${data[i].nama}</td>
                                        <td>${data[i].merk}</td>
                                        <td>${data[i].warna}</td>
                                        <td>${data[i].no_polisi}</td>
                                        <td>${data[i].status_aset}</td>
                                        <input type="hidden" name="aset_kendaraan[]" value="${data[i].id_aset_kendaraan}">
                                    </tr>
                                        `;
                                    $('#asetKendaraanTerpilih').append(tableRow);
                                }
                                // Hapus aset yang telah dipilih dari modal
                                $(`#asetListModal input[value="${asetId}"]`).closest(
                                    'tr').remove()

                            } else if (jenis === 'inventaris_ruangan') {
                                const asetId = data[i].id_aset_inventaris_ruangan;
                                if (!asetTerpilih.hasOwnProperty(asetId)) {
                                    asetTerpilih[asetId] = true;
                                    let tableRow = `
                                    <tr>
                                        <td>${data[i].kode_aset}</td>
                                        <td>${data[i].nama}</td>
                                        <td>${data[i].merk}</td>
                                        <td>${data[i].bahan}</td>
                                        <td>${data[i].jumlah}</td>
                                        <td>${data[i].status_aset}</td>
                                        <input type="hidden" name="aset_inventaris_ruangan[]" value="${data[i].id_aset_inventaris_ruangan}">
                                    </tr>
                                        `;
                                    $('#asetInventarisRuanganTerpilih').append(tableRow);
                                }
                                // Hapus aset yang telah dipilih dari modal
                                $(`#asetListModal input[value="${asetId}"]`).closest(
                                    'tr').remove()

                            }
                        }
                    },
                });
            });
        });
    </script>
@endpush
