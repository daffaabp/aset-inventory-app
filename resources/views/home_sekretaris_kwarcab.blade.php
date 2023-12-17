@extends('layouts.master')
@push('css')
    <style>
        .scrollable-tab-content {
            max-height: 500px;
            overflow-y: auto;
        }
    </style>
@endpush
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Beranda Sekretaris Kwarcab</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Beranda Sekretaris Kwarcab</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <h5 class="card-title mb-0" style="text-align: center; margin-top: 17px;">Progres Peminjaman</h5>


                @if (session('notifikasi'))
                    <div class="alert alert-danger bg-danger">
                        <ul>6
                            @foreach (session('notifikasi') as $notif)
                                <li>{{ $notif['pesan'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="card-body">
                    <div id="basic-pills-wizard" class="tab-pane">
                        <ul class="nav nav-tabs">
                            <li class="nav-item @if ($activeTab === 'diproses') active @endif">
                                <a href="#diproses" class="nav-link @if ($activeTab === 'diproses') active @endif"
                                    data-toggle="tab">
                                    <div class="step-icon @if ($activeTab === 'diproses') active @endif"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Diproses">
                                        <i class="fa fa-undo"></i> DIPROSES
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item @if ($activeTab === 'diacc') active @endif">
                                <a href="#diacc" class="nav-link @if ($activeTab === 'diacc') active @endif"
                                    data-toggle="tab">
                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="ACC">
                                        <i class="fa fa-check"></i> DI ACC
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item @if ($activeTab === 'selesai') active @endif">
                                <a href="#selesai" class="nav-link @if ($activeTab === 'selesai') active @endif"
                                    data-toggle="tab">
                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Selesai">
                                        <i class="fa fa-flag-checkered"></i> SELESAI
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item @if ($activeTab === 'ditolak') active @endif">
                                <a href="#ditolak" class="nav-link @if ($activeTab === 'ditolak') active @endif"
                                    data-toggle="tab">
                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Ditolak">
                                        <i class="fa fa-times"></i> DITOLAK
                                    </div>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content scrollable-tab-content">
                            <div class="tab-pane @if ($activeTab === 'diproses') active @endif" id="diproses">

                                @if ($peminjamanDikirim->isEmpty())
                                    <h6 style="text-align: center;">Belum Ada Peminjaman yang Baru Anda Buat</h6>
                                @else
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tgl Pengajuan</th>
                                                <th>Tgl Rencana Pinjam</th>
                                                <th>Tgl Rencana Kembali</th>
                                                <th>Kegunaan</th>
                                                <th>Status Verifikasi</th>
                                                <th>Lihat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($peminjamanDikirim as $index => $peminjaman)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_pengajuan)->isoFormat('llll') }}
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($peminjaman->tgl_rencana_pinjam)->isoFormat('dddd, D MMMM Y') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_rencana_kembali)->isoFormat('dddd, D MMMM Y') }}
                                                    </td>
                                                    <td>{{ $peminjaman->kegunaan }}
                                                    </td>
                                                    <td>
                                                        @if ($peminjaman->status_verifikasi === 'Dikirim')
                                                            <span class="badge badge-warning">Sedang Diproses</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form
                                                            action="{{ route('verifikasiPeminjamanDetails', $peminjaman->id_peminjaman) }}">
                                                            <button type="submit" class="btn btn-primary"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Lihat"><i class="fa fa-eye"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif

                                <div class="col-lg-12 text-end">
                                    <ul class="pager wizard twitter-bs-wizard-pager-link">
                                        <li class="next">
                                            <a href="javascript: void(0);" class="btn btn-primary"
                                                onclick="nextTab('diacc')">
                                                Next <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="tab-pane @if ($activeTab === 'diacc') active @endif" id="diacc">
                                <div>
                                    @if ($peminjamanACC->isEmpty())
                                        <h6 style="text-align: center;">Belum Ada Peminjaman Yang Sedang Berlangsung</h6>
                                    @else
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tgl Pengajuan</th>
                                                    <th>Tgl Rencana Pinjam</th>
                                                    <th>Tgl Rencana Kembali</th>
                                                    <th>Kegunaan</th>
                                                    <th>Status Verifikasi</th>
                                                    <th>Tgl Di ACC</th>
                                                    <th>Petugas</th>
                                                    <th>Lihat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($peminjamanACC as $index => $peminjaman)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_pengajuan)->isoFormat('ll LT') }}
                                                        </td>



                                                        <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_rencana_pinjam)->isoFormat('LL') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_rencana_kembali)->isoFormat('LL') }}
                                                        </td>
                                                        <td>{{ $peminjaman->kegunaan }}</td>
                                                        <td>
                                                            @if ($peminjaman->status_verifikasi === 'ACC')
                                                                <span class="badge badge-success">ACC (Sedang
                                                                    Dipinjam)</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_acc)->isoFormat('ll LT') }}
                                                        <td>{{ $peminjaman->usersPetugas->name }}</td>
                                                        <td>
                                                            <form
                                                                action="{{ route('verifikasiPeminjamanDetails', $peminjaman->id_peminjaman) }}">
                                                                <button type="submit" class="btn btn-primary"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Lihat"><i class="fa fa-eye"></i></button>
                                                            </form>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                <li class="previous disabled">
                                                    <a href="javascript: void(0);" class="btn btn-primary"
                                                        onclick="prevTab()">
                                                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Previous
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6 text-end">
                                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                <li class="next">
                                                    <a href="javascript: void(0);" class="btn btn-primary"
                                                        onclick="nextTab('selesai')">
                                                        Next <i class="fa fa-arrow-right" aria-hidden="true"></i>

                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane @if ($activeTab === 'selesai') active @endif" id="selesai">
                                <div>

                                    @if ($peminjamanSelesai->isEmpty())
                                        <h6 style="text-align: center;">Belum Ada Peminjaman Yang Selesai</h6>
                                    @else
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tgl Pengajuan</th>
                                                    <th>Tgl Rencana Pinjam</th>
                                                    <th>Tgl Rencana Kembali</th>
                                                    <th>Kegunaan</th>
                                                    <th>Status Verifikasi</th>
                                                    <th>Lihat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($peminjamanSelesai as $index => $peminjaman)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_pengajuan)->isoFormat('llll') }}
                                                        </td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($peminjaman->tgl_rencana_pinjam)->isoFormat('dddd, D MMMM Y') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_rencana_kembali)->isoFormat('dddd, D MMMM Y') }}
                                                        </td>
                                                        <td>{{ $peminjaman->kegunaan }}
                                                        </td>
                                                        <td>
                                                            @if ($peminjaman->status_verifikasi === 'Selesai')
                                                                <span class="badge"
                                                                    style="background-color: blue; color: white;">Selesai</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('verifikasiPeminjamanDetails', $peminjaman->id_peminjaman) }}">
                                                                <button type="submit" class="btn btn-primary"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Lihat"><i class="fa fa-eye"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                <li class="previous disabled">
                                                    <a href="javascript: void(0);" class="btn btn-primary"
                                                        onclick="prevTab()">
                                                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Previous
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6 text-end">
                                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                <li class="next">
                                                    <a href="javascript: void(0);" class="btn btn-primary"
                                                        onclick="nextTab('ditolak')">
                                                        Next <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane @if ($activeTab === 'ditolak') active @endif" id="ditolak">
                                <div>

                                    @if ($peminjamanDitolak->isEmpty())
                                        <h6 style="text-align: center;">Belum Ada Peminjaman Yang Ditolak</h6>
                                    @else
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tgl Pengajuan</th>
                                                    <th>Tgl Rencana Pinjam</th>
                                                    <th>Tgl Rencana Kembali</th>
                                                    <th>Kegunaan</th>
                                                    <th>Status Verifikasi</th>
                                                    <th>Tgl Ditolak</th>
                                                    <th>Petugas</th>
                                                    <th>Lihat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($peminjamanDitolak as $index => $peminjaman)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_pengajuan)->isoFormat('llll') }}
                                                        </td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($peminjaman->tgl_rencana_pinjam)->isoFormat('dddd, D MMMM Y') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_rencana_kembali)->isoFormat('dddd, D MMMM Y') }}
                                                        </td>
                                                        <td>{{ $peminjaman->kegunaan }}
                                                        </td>
                                                        <td>
                                                            @if ($peminjaman->status_verifikasi === 'Ditolak')
                                                                <span class="badge badge-danger">Ditolak</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_ditolak)->isoFormat('llll') }}
                                                        </td>
                                                        <td>{{ $peminjaman->usersPetugas->name }}</td>
                                                        <td>
                                                            <form
                                                                action="{{ route('verifikasiPeminjamanDetails', $peminjaman->id_peminjaman) }}">
                                                                <button type="submit" class="btn btn-primary"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Lihat"><i class="fa fa-eye"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif

                                    <div class="col-lg-6">
                                        <ul class="pager wizard twitter-bs-wizard-pager-link">
                                            <li class="previous disabled">
                                                <a href="javascript: void(0);" class="btn btn-primary"
                                                    onclick="prevTab()">
                                                    <i class="bx bx-chevron-left me-1"></i> Previous
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <script src="{{ URL::to('assets/js/feather.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/twitter-bootstrap-wizard/prettify.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/twitter-bootstrap-wizard/form-wizard.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ganti 'ditolak' atau 'selesai' dengan tab default setelah 5 menit
            setTimeout(function() {
                changeActiveTab('diproses'); // Ubah ini sesuai dengan tab default
            }, 300000); // 300000 milidetik = 5 menit
        });

        function changeActiveTab(tabId) {
            // Hapus class 'active' dari semua tab
            document.querySelectorAll('.nav-link').forEach(function(tab) {
                tab.classList.remove('active');
            });

            // Hapus class 'active' dari semua tab-pane
            document.querySelectorAll('.tab-pane').forEach(function(tabPane) {
                tabPane.classList.remove('active', 'show');
            });

            // Tambahkan class 'active' ke tab yang diinginkan
            document.querySelector(`[href="#${tabId}"]`).classList.add('active');

            // Tambahkan class 'active' dan 'show' ke tab-pane yang diinginkan
            document.querySelector(`#${tabId}`).classList.add('active', 'show');

            // Simulasikan klik pada tab yang diinginkan
            document.querySelector(`[href="#${tabId}"]`).click();
        }
    </script>

    <script>
        $(document).ready(function() {
            // Menangani klik pada tombol dengan class 'nav-link'
            $('.nav-link').on('click', function(e) {
                e.preventDefault(); // Mencegah default action dari link

                // Menghapus class 'active' dari semua tab dan tab content
                $('.nav-link, .tab-pane').removeClass('active');

                // Menambahkan class 'active' ke tombol yang diklik
                $(this).addClass('active');

                // Mengambil href dari tombol yang diklik (contoh: '#diproses')
                var targetTab = $(this).attr('href');

                // Menambahkan class 'active' ke tab content yang sesuai dengan href tombol
                $(targetTab).addClass('active');

                // Menampilkan tab content yang sesuai dengan href tombol
                $(targetTab).tab('show');
            });
        });
    </script>
@endpush
