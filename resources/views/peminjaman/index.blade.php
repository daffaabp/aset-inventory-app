@extends('layouts.master')

@push('css')
    <style>
        .modal-content {
            max-height: 80vh;
            overflow-y: auto;
        }

        .sticky-header-footer {
            position: sticky;
            top: 0;

            bottom: 0;
            background-color: white;
            z-index: 1000;
        }

        .table-container {
            max-height: 340px;
            overflow-y: auto;
        }
    </style>
@endpush
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
                                    <input type="text" name="kegunaan" value="{{ old('kegunaan') }}" autocomplete="off"
                                        autofocus class="form-control @error('kegunaan') is-invalid @enderror">
                                    @error('kegunaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="form-group local-forms">
                                    <label>Tgl Rencana Pinjam <span class="login-danger">*</span></label>
                                    <input type="date" name="tgl_rencana_pinjam" value="{{ old('tgl_rencana_pinjam') }}"
                                        autocomplete="off" autofocus
                                        class="form-control @error('tgl_rencana_pinjam') is-invalid @enderror">
                                    @error('tgl_rencana_pinjam')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="form-group local-forms">
                                    <label>Tgl Rencana Kembali <span class="login-danger">*</span></label>
                                    <input type="date" name="tgl_rencana_kembali"
                                        value="{{ old('tgl_rencana_kembali') }}" autocomplete="off" autofocus
                                        class="form-control @error('tgl_rencana_kembali') is-invalid @enderror">
                                    @error('tgl_rencana_kembali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                        <div class="table-container">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Kode Aset</th>
                                                            <th scope="col">Nama Tanah</th>
                                                            <th scope="col">Lokasi Tanah</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Hapus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="asetTanahTerpilih">
                                                        <!-- Isi tabel akan diisi melalui JavaScript -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Tab Pane Aset Gedung --}}
                                    <div class="tab-pane show" id="aset_gedung">
                                        <div class="col-lg-2">
                                            <button type="button" class="mt-1 btn btn-info btn-modal-load"
                                                data-aset="gedung" data-bs-toggle="modal"
                                                data-bs-target="#bs-example-modal-lg">Tambah</button>
                                        </div><br>
                                        <div class="table-container">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Kode Aset</th>
                                                            <th scope="col">Nama Gedung</th>
                                                            <th scope="col">Lokasi Gedung</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Hapus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="asetGedungTerpilih">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Tab Pane Aset Kendaraan --}}
                                    <div class="tab-pane show" id="aset_kendaraan">
                                        <div class="col-lg-2">
                                            <button type="button" class="mt-1 btn btn-info btn-modal-load"
                                                data-aset="kendaraan" data-bs-toggle="modal"
                                                data-bs-target="#bs-example-modal-lg">Tambah</button>
                                        </div><br>
                                        <div class="table-container">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Kode Aset</th>
                                                            <th scope="col">Nama Kendaraan</th>
                                                            <th scope="col">Merk</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">No Polisi</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Hapus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="asetKendaraanTerpilih">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Tab Pane Aset Inventaris Ruangan --}}
                                    <div class="tab-pane show" id="aset_inventaris_ruangan">
                                        <div class="col-lg-2">
                                            <button type="button" class="mt-1 btn btn-info btn-modal-load"
                                                data-aset="inventaris_ruangan" data-bs-toggle="modal"
                                                data-bs-target="#bs-example-modal-lg">Tambah</button>
                                        </div><br>
                                        <div class="table-container">
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
                                                            <th scope="col">Hapus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="asetInventarisRuanganTerpilih">

                                                    </tbody>
                                                </table>
                                            </div>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header sticky-header-footer">
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

                    <div class="modal-footer sticky-header-footer">
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
            let asetTerpilih = {};

            function clearModalData() {
                asetTerpilih = {};
            }

            $(document).on('click', '#asetListModal tr', function(event) {
                if (event.target.type !== 'checkbox') {
                    let checkbox = $(this).find('input[type="checkbox"]');

                    checkbox.prop('checked', !checkbox.prop('checked'));
                }
            });

            $(".btn-modal-load").on('click', function() {

                let e = $(this);
                let jenis = e.data('aset');

                let selectedAset = '';

                let koma = "";
                $('.selected-aset-' + jenis).each(function() {
                    selectedAset += `${koma}"${$(this).text()}"`;
                    koma = ",";
                });

                clearModalData();

                $.ajax({
                    url: "{{ route('getAset') }}",
                    type: "GET",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'jenis': jenis,
                        'kode_asets': selectedAset
                    },
                    success: function(data) {
                        $("#asetFormModel-jenis").val(jenis);

                        let title = e.data('title') || 'Default Modal Title';
                        $('#modalTitle').text(title);

                        let modalTitle = $('#scrollable-modal .modal-title');
                        modalTitle.removeClass().addClass('modal-title ' + e.data('class'));

                        $('#asetListModal').html(data);

                        for (let jenisAset in asetTerpilih) {
                            for (let asetId in asetTerpilih[jenisAset]) {

                                $(`#asetListModal input[value="${asetTerpilih[jenisAset][asetId]}"]`)
                                    .closest('tr').remove();
                            }
                        }
                    },
                });
            });

            function handleCeklist(row) {
                let jenis = $("#asetFormModel-jenis").val();
                let asetId = row.find('input[type="checkbox"]').val();

                if (!asetTerpilih.hasOwnProperty(jenis)) {
                    asetTerpilih[jenis] = {};
                }

                if (row.find('input[type="checkbox"]').prop("checked")) {
                    asetTerpilih[jenis][asetId] = asetId;
                } else {
                    delete asetTerpilih[jenis][asetId];
                }
            }

            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                clearModalData();
            });


            $("#asetFormModel").on('submit', function(e) {
                e.preventDefault();
                let tambahButton = $("#asetBtnModal");

                tambahButton.prop('disabled', true);
                tambahButton.html('Jangan Terlalu Rajin Klik ...');
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

                                if (!asetTerpilih.hasOwnProperty('tanah')) {
                                    asetTerpilih['tanah'] = true;
                                }
                                if (!asetTerpilih['tanah'].hasOwnProperty(asetId)) {
                                    asetTerpilih['tanah'][asetId] = true;

                                    $(`#asetListModal input[value="${asetId}"]`).closest(
                                            'tr')
                                        .remove();

                                    let tableRow = `
                                    <tr>
                                        <td class="selected-aset-${jenis}">${data[i].kode_aset}</td>
                                        <td>${data[i].nama}</td>
                                        <td>${data[i].letak_tanah}</td>
                                        <td>${data[i].status_aset}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-hapus-aset" data-jenis="${jenis}" data-id="${data[i].id_aset_tanah}">
                                            Hapus
                                        </button>
                                        </td>
                                        <input type="hidden" name="aset_tanah[]" value="${data[i].id_aset_tanah}">
                                    </tr>
                                        `;
                                    $('#asetTanahTerpilih').append(tableRow);

                                    if (!asetTerpilih.hasOwnProperty(jenis)) {
                                        asetTerpilih[jenis] = {};
                                    }
                                    asetTerpilih[jenis][data[i].id] = data[i].id;

                                    $(`#asetListModal input[value="${asetId}"]`).closest(
                                        'tr').remove()
                                }

                            } else if (jenis === 'gedung') {
                                const asetId = data[i].id_aset_gedung;
                                if (!asetTerpilih.hasOwnProperty('gedung')) {
                                    asetTerpilih['gedung'] = true;
                                }
                                if (!asetTerpilih['gedung'].hasOwnProperty(asetId)) {
                                    asetTerpilih['gedung'][asetId] = true;
                                    let tableRow = `
                                    <tr>
                                        <td class="selected-aset-${jenis}">${data[i].kode_aset}</td>
                                        <td>${data[i].nama}</td>
                                        <td>${data[i].lokasi}</td>
                                        <td>${data[i].status_aset}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-hapus-aset" data-jenis="${jenis}" data-id="${data[i].id_aset_gedung}">
                                            Hapus
                                        </button>
                                        </td>
                                        <input type="hidden" name="aset_gedung[]" value="${data[i].id_aset_gedung}">
                                    </tr>
                                        `;
                                    $('#asetGedungTerpilih').append(tableRow);

                                    if (!asetTerpilih.hasOwnProperty(jenis)) {
                                        asetTerpilih[jenis] = {};
                                    }
                                    asetTerpilih[jenis][data[i].id] = data[i].id;

                                    $(`#asetListModal input[value="${asetId}"]`).closest(
                                        'tr').remove()
                                }

                            } else if (jenis === 'kendaraan') {
                                const asetId = data[i].id_aset_kendaraan;
                                if (!asetTerpilih.hasOwnProperty('kendaraan')) {
                                    asetTerpilih['kendaraan'] = true;
                                }
                                if (!asetTerpilih['kendaraan'].hasOwnProperty(asetId)) {
                                    asetTerpilih['kendaraan'][asetId] = true;
                                    let tableRow = `
                                    <tr>
                                        <td class="selected-aset-${jenis}">${data[i].kode_aset}</td>
                                        <td>${data[i].nama}</td>
                                        <td>${data[i].merk}</td>
                                        <td>${data[i].type}</td>
                                        <td>${data[i].no_polisi}</td>
                                        <td>${data[i].status_aset}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-hapus-aset" data-jenis="${jenis}" data-id="${data[i].id_aset_kendaraan}">
                                            Hapus
                                        </button>
                                        </td>
                                        <input type="hidden" name="aset_kendaraan[]" value="${data[i].id_aset_kendaraan}">
                                    </tr>
                                        `;
                                    $('#asetKendaraanTerpilih').append(tableRow);

                                    if (!asetTerpilih.hasOwnProperty(jenis)) {
                                        asetTerpilih[jenis] = {};
                                    }
                                    asetTerpilih[jenis][data[i].id] = data[i].id;

                                    $(`#asetListModal input[value="${asetId}"]`).closest(
                                        'tr').remove()
                                }

                            } else if (jenis === 'inventaris_ruangan') {
                                const asetId = data[i].id_aset_inventaris_ruangan;

                                if (!asetTerpilih.hasOwnProperty('inventaris_ruangan')) {
                                    asetTerpilih['inventaris_ruangan'] = true;
                                }
                                if (!asetTerpilih['inventaris_ruangan'].hasOwnProperty(
                                        asetId)) {
                                    asetTerpilih['inventaris_ruangan'][asetId] = true;
                                    let tableRow = `
                                    <tr>
                                        <td class="selected-aset-${jenis}">${data[i].kode_aset}</td>
                                        <td>${data[i].nama}</td>
                                        <td>${data[i].merk}</td>
                                        <td>${data[i].bahan}</td>
                                        <td>${data[i].jumlah}</td>
                                        <td>${data[i].status_aset}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-hapus-aset" data-jenis="${jenis}" data-id="${data[i].id_aset_inventaris}">
                                            Hapus
                                        </button>
                                        </td>
                                        <input type="hidden" name="aset_inventaris_ruangan[]" value="${data[i].id_aset_inventaris_ruangan}">
                                    </tr>
                                        `;
                                    $('#asetInventarisRuanganTerpilih').append(tableRow);

                                    if (!asetTerpilih.hasOwnProperty(jenis)) {
                                        asetTerpilih[jenis] = {};
                                    }
                                    asetTerpilih[jenis][data[i].id] = data[i].id;

                                    $(`#asetListModal input[value="${asetId}"]`).closest(
                                        'tr').remove();
                                }
                            }
                        }

                        tambahButton.prop('disabled', false);
                        tambahButton.html('Tambah');
                    },
                    error: function(err) {
                        console.error('Error:', err);

                        tambahButton.prop('disabled', false);
                        tambahButton.html('Tambah');
                    }
                });
            });

            $(document).on('click', '.btn-hapus-aset', function() {
                let jenisAset = $(this).data('jenis');
                let asetId = $(this).data('id');

                $(`#asetTanahTerpilih input[value="${asetId}"]`).closest('tr').remove();
                $(`#asetGedungTerpilih input[value="${asetId}"]`).closest('tr').remove();
                $(`#asetKendaraanTerpilih input[value="${asetId}"]`).closest('tr').remove();
                $(`#asetInventarisRuanganTerpilih input[value="${asetId}"]`).closest('tr').remove();
            });
        });

        @if (Session::has('error'))
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.error("{{ Session::get('error') }}", 'Gagal!', {
                timeOut: 5000,
            });
        @endif
    </script>
@endpush
