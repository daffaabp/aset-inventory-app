@extends('layouts.master')

@push('css')
    <style>
        .modal-content {
            max-height: 80vh;
            /* Atur tinggi maksimal modal */
            overflow-y: auto;
            /* Gunakan overflow-y untuk menambahkan scroll jika konten terlalu tinggi */
        }

        .sticky-header-footer {
            position: sticky;
            top: 0;
            /* Untuk header, tetap di bagian atas */
            bottom: 0;
            /* Untuk footer, tetap di bagian bawah */
            background-color: white;
            /* Sesuaikan warna latar belakang dengan kebutuhan Anda */
            z-index: 1000;
            /* Pastikan lebih tinggi dari kontennya agar tumpang tindih saat di-scroll */
        }

        .table-container {
            max-height: 340px;
            /* Sesuaikan dengan tinggi maksimal yang Anda inginkan */
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
                                                            <th scope="col">Warna</th>
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
                        <div class="form-group">
                            <label for="searchInput">Cari Aset</label>
                            <input type="text" class="form-control" id="searchInput"
                                placeholder="Masukkan nama aset...">
                        </div>
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
            // Membuat objek untuk melacak aset yang telah dipilih
            let asetTerpilih = {};
            // Fungsi untuk membersihkan atau mereset data modal
            function clearModalData() {
                asetTerpilih = {};
            }

            // Tambahkan event listener untuk baris aset di modal
            $(document).on('click', '#asetListModal tr', function(event) {
                // Cek apakah yang diklik adalah checkbox
                if (event.target.type !== 'checkbox') {
                    // Temukan checkbox di dalam baris yang diklik
                    let checkbox = $(this).find('input[type="checkbox"]');

                    // Ubah status ceklist pada checkbox
                    checkbox.prop('checked', !checkbox.prop('checked'));
                }
            });

            $(".btn-modal-load").on('click', function() {
                let e = $(this);

                // Tambahkan pengecekan sebelum mengambil data dari server
                if (asetTerpilih.hasOwnProperty(e.data('aset'))) {
                    // Jika sudah ada data untuk jenis aset ini, tidak perlu mengambil dari server
                    return;
                }

                // Panggil fungsi pembersihan sebelum membuka modal baru
                clearModalData();

                $.ajax({
                    url: "{{ route('getAset') }}",
                    type: "GET",
                    data: {
                        '_token': '{{ csrf_token() }}', // Tambahkan token CSRF di sini
                        'jenis': e.data('aset')
                    },
                    success: function(data) {
                        $("#asetFormModel-jenis").val(e.data('aset'));

                        // Ganti teks judul modal dengan data-title
                        let title = e.data('title') || 'Default Modal Title';
                        $('#modalTitle').text(title);

                        // Tambahkan class dan CSS ke elemen judul modal
                        let modalTitle = $('#scrollable-modal .modal-title');
                        modalTitle.removeClass().addClass('modal-title ' + e.data('class'));

                        // Hapus semua aset yang telah dipilih sebelumnya dari modal
                        $('#asetListModal').html(data);

                        // Sembunyikan atau hapus aset yang telah dipilih
                        for (let jenisAset in asetTerpilih) {
                            for (let asetId in asetTerpilih[jenisAset]) {

                                $(`#asetListModal input[value="${asetTerpilih[jenisAset][asetId]}"]`)
                                    .closest('tr').remove();
                            }
                        }
                    },
                });
            });


            // Fungsi untuk menangani perubahan ceklist
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

            // Panggil fungsi pembersihan saat tab berubah
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                clearModalData();
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

                                if (!asetTerpilih.hasOwnProperty('tanah')) {
                                    asetTerpilih['tanah'] = true;
                                }
                                if (!asetTerpilih['tanah'].hasOwnProperty(asetId)) {
                                    asetTerpilih['tanah'][asetId] = true;

                                    // Hapus baris tabel
                                    $(`#asetListModal input[value="${asetId}"]`).closest(
                                            'tr')
                                        .remove();

                                    let tableRow = `
                                    <tr>
                                        <td>${data[i].kode_aset}</td>
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

                                    // Tambahkan data ke objek asetTerpilih
                                    if (!asetTerpilih.hasOwnProperty(jenis)) {
                                        asetTerpilih[jenis] = {};
                                    }
                                    asetTerpilih[jenis][data[i].id] = data[i].id;

                                    // Hapus aset yang telah dipilih dari modal
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
                                        <td>${data[i].kode_aset}</td>
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

                                    // Tambahkan data ke objek asetTerpilih
                                    if (!asetTerpilih.hasOwnProperty(jenis)) {
                                        asetTerpilih[jenis] = {};
                                    }
                                    asetTerpilih[jenis][data[i].id] = data[i].id;

                                    // Hapus aset yang telah dipilih dari modal
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
                                        <td>${data[i].kode_aset}</td>
                                        <td>${data[i].nama}</td>
                                        <td>${data[i].merk}</td>
                                        <td>${data[i].warna}</td>
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

                                    // Tambahkan data ke objek asetTerpilih
                                    if (!asetTerpilih.hasOwnProperty(jenis)) {
                                        asetTerpilih[jenis] = {};
                                    }
                                    asetTerpilih[jenis][data[i].id] = data[i].id;

                                    // Hapus aset yang telah dipilih dari modal
                                    $(`#asetListModal input[value="${asetId}"]`).closest(
                                        'tr').remove()
                                }


                            } else if (jenis === 'inventaris_ruangan') {
                                const asetId = data[i].id_aset_inventaris_ruangan;

                                //  cek jika aset terpilih dari tabel inventaris ruangan
                                if (!asetTerpilih.hasOwnProperty('inventaris_ruangan')) {
                                    asetTerpilih['inventaris_ruangan'] = true;
                                }
                                if (!asetTerpilih['inventaris_ruangan'].hasOwnProperty(
                                        asetId)) {
                                    asetTerpilih['inventaris_ruangan'][asetId] = true;
                                    let tableRow = `
                                    <tr>
                                        <td>${data[i].kode_aset}</td>
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

                                    // Tambahkan data ke objek asetTerpilih
                                    if (!asetTerpilih.hasOwnProperty(jenis)) {
                                        asetTerpilih[jenis] = {};
                                    }
                                    asetTerpilih[jenis][data[i].id] = data[i].id;

                                    // Hapus aset yang telah dipilih dari modal
                                    $(`#asetListModal input[value="${asetId}"]`).closest(
                                        'tr').remove();
                                }
                            }
                        }
                    },
                });
            });

            // Penanganan klik tombol hapus
            $(document).on('click', '.btn-hapus-aset', function() {
                let jenisAset = $(this).data('jenis');
                let asetId = $(this).data('id');

                // Hapus baris dari tabel terpilih
                $(`#asetTanahTerpilih input[value="${asetId}"]`).closest('tr').remove();

            });

            // Fungsi untuk menangani setiap perubahan pada input pencarian
            $('#searchInput').on('input', function() {
                // Mendapatkan nilai input pencarian
                var searchValue = $(this).val();

                // Mendapatkan jenis aset dari modal atau sumber data
                var jenisAset = $('#asetFormModel-jenis').val();

                // Memanggil fungsi pencarian Ajax dengan nilai pencarian
                searchAset(jenisAset, searchValue);
            });

            // Fungsi untuk melakukan pencarian menggunakan Ajax
            function searchAset(jenisAset, keyword) {
                // Mengirim permintaan Ajax
                $.ajax({
                    type: 'GET',
                    url: '/search-aset', // Ganti dengan URL atau rute yang sesuai di aplikasi Anda
                    data: {
                        jenis: jenisAset,
                        keyword: keyword
                    },
                    success: function(data) {
                        // Memperbarui isi tabel atau daftar dengan hasil pencarian
                        $('#asetListModal').html(data);
                    },
                    error: function(error) {
                        console.error('Error during search:', error);
                    }
                });
            }
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
