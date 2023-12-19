@extends('layouts.master')
@push('css')
    <style>
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
                <h3 class="page-title">Verifikasi Details Peminjaman</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Verifikasi Details Peminjaman</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    @if (session('errors'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach (session('errors') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('processVerification', $peminjaman->id_peminjaman) }}"
                        id="verificationForm">
                        @csrf

                        @if (auth()->user()->hasRole('Petugas'))
                            <div class="d-flex justify-content-center align-items-center" style="margin-bottom: 7px;">
                                @if ($peminjaman->status_verifikasi === 'Dikirim')
                                    <div class="peminjaman-submit" style="margin-right: 10px">
                                        <button type="submit" name="accept" class="btn btn-success">ACC
                                            PEMINJAMAN</button>
                                    </div>

                                    <div class="peminjaman-submit">
                                        <button type="button" id="rejectButton" class="btn btn-danger">TOLAK
                                            PEMINJAMAN</button>
                                    </div>
                                @endif
                                @if ($peminjaman->status_verifikasi === 'ACC')
                                    <div class="peminjaman-submit">
                                        <button type="submit" name="finish" class="btn btn-primary">SELESAI
                                            PEMINJAMAN</button>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <br>

                        <div class="row">
                            <div class="col-12 col-sm-3">
                                <div class="form-group local-forms">
                                    <label>Peminjam <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ $peminjaman->usersPeminjam->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-2">
                                <div class="form-group local-forms">
                                    <label>Tgl Rencana Pinjam <span class="login-danger">*</span></label>
                                    <input type="date" class="form-control" value="{{ $peminjaman->tgl_rencana_pinjam }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-2">
                                <div class="form-group local-forms">
                                    <label>Tgl Rencana Kembali <span class="login-danger">*</span></label>
                                    <input type="date" class="form-control"
                                        value="{{ $peminjaman->tgl_rencana_kembali }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-5">
                                <div class="form-group local-forms">
                                    <label>Detail Kegunaan Pinjam <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ $peminjaman->kegunaan }}" readonly>
                                </div>
                            </div>
                        </div>

                        {{-- Accordion Tab Aset Tanah --}}

                        <div class="card">
                            <div class="card-body" style="margin-top: -40px;">
                                <h5 class="mb-4 header-title">
                                    Daftar Aset Yang Dipinjam</h5>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="#aset_tanah" data-bs-toggle="tab" aria-expanded="true"
                                            class="nav-link active">
                                            Aset Tanah
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#aset_gedung" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                            Aset Gedung
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#aset_kendaraan" data-bs-toggle="tab" aria-expanded="false"
                                            class="nav-link">
                                            Aset Kendaraan
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#aset_inventaris_ruangan" data-bs-toggle="tab" aria-expanded="false"
                                            class="nav-link">
                                            Aset Inventaris Ruangan
                                        </a>

                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane show active" id="aset_tanah">
                                        <div class="table-container">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">No</th>
                                                            <th scope="col">Kode Tanah</th>
                                                            <th scope="col">Nama Tanah</th>
                                                            <th scope="col">Letak Tanah</th>
                                                            @if (auth()->user()->hasRole('Petugas'))
                                                                @if ($peminjaman->status_verifikasi === 'Dikirim' || $peminjaman->status_verifikasi === 'ACC')
                                                                    <th scope="col">Status</th>
                                                                @endif
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($riwayatPeminjamanTanah as $aset)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $aset->kode_aset }}</td>
                                                                <td>{{ $aset->nama }}</td>
                                                                <td>{{ $aset->letak_tanah }}</td>
                                                                @if (auth()->user()->hasRole('Petugas'))
                                                                    @if ($peminjaman->status_verifikasi == 'Dikirim')
                                                                        <td>
                                                                            {{ $aset->statusAset->status_aset }}
                                                                        </td>
                                                                    @elseif ($peminjaman->status_verifikasi == 'ACC')
                                                                        <td>
                                                                            <select
                                                                                name="riwayatPeminjamanTanah[status][{{ $aset->id }}]"
                                                                                class="form-select"
                                                                                style="height: 35px; width: 160px;"
                                                                                id="status_aset"
                                                                                aria-label="Default select example">

                                                                                @if ($aset->statusAset->id_status_aset == 2)
                                                                                    <option value="1"
                                                                                        {{ $aset->statusAset->id_status_aset == 1 ? 'selected' : '' }}>
                                                                                        Baik</option>
                                                                                    <option value="3"
                                                                                        {{ $aset->statusAset->id_status_aset == 3 ? 'selected' : '' }}>
                                                                                        Rusak</option>
                                                                                @endif
                                                                            </select>
                                                                        </td>
                                                                    @endif
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane show" id="aset_gedung">
                                        <div class="table-container">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">No</th>
                                                            <th scope="col">Kode Gedung</th>
                                                            <th scope="col">Nama Gedung</th>
                                                            <th scope="col">Lokasi Gedung</th>
                                                            @if (auth()->user()->hasRole('Petugas'))
                                                                @if ($peminjaman->status_verifikasi === 'Dikirim' || $peminjaman->status_verifikasi === 'ACC')
                                                                    <th scope="col">Status</th>
                                                                @endif
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($riwayatPeminjamanGedung as $aset)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $aset->kode_aset }}</td>
                                                                <td>{{ $aset->nama }}</td>
                                                                <td>{{ $aset->lokasi }}</td>
                                                                @if (auth()->user()->hasRole('Petugas'))
                                                                    @if ($peminjaman->status_verifikasi == 'Dikirim')
                                                                        <td>
                                                                            {{ $aset->statusAset->status_aset }}
                                                                        </td>
                                                                    @elseif ($peminjaman->status_verifikasi == 'ACC')
                                                                        <td>
                                                                            <select
                                                                                name="riwayatPeminjamanGedung[status][{{ $aset->id }}]"
                                                                                class="form-select"
                                                                                style="height: 35px; width: 160px;"
                                                                                id="status_aset"
                                                                                aria-label="Default select example">

                                                                                @if ($aset->statusAset->id_status_aset == 2)
                                                                                    <option value="1"
                                                                                        {{ $aset->statusAset->id_status_aset == 1 ? 'selected' : '' }}>
                                                                                        Baik</option>
                                                                                    <option value="3"
                                                                                        {{ $aset->statusAset->id_status_aset == 3 ? 'selected' : '' }}>
                                                                                        Rusak</option>
                                                                                @endif
                                                                            </select>
                                                                        </td>
                                                                    @endif
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane show" id="aset_kendaraan">
                                        <div class="table-container">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">No</th>
                                                            <th scope="col">Kode Kendaraan</th>
                                                            <th scope="col">Nama Kendaraan</th>
                                                            <th scope="col">Merk</th>
                                                            <th scope="col">Warna</th>
                                                            <th scope="col">No Polisi</th>
                                                            @if (auth()->user()->hasRole('Petugas'))
                                                                @if ($peminjaman->status_verifikasi === 'Dikirim' || $peminjaman->status_verifikasi === 'ACC')
                                                                    <th scope="col">Status</th>
                                                                @endif
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($riwayatPeminjamanKendaraan as $aset)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $aset->kode_aset }}</td>
                                                                <td>{{ $aset->nama }}</td>
                                                                <td>{{ $aset->merk }}</td>
                                                                <td>{{ $aset->warna }}</td>
                                                                <td>{{ $aset->no_polisi }}</td>
                                                                @if (auth()->user()->hasRole('Petugas'))
                                                                    @if ($peminjaman->status_verifikasi == 'Dikirim')
                                                                        <td>
                                                                            {{ $aset->statusAset->status_aset }}
                                                                        </td>
                                                                    @elseif ($peminjaman->status_verifikasi == 'ACC')
                                                                        <td>
                                                                            <select
                                                                                name="riwayatPeminjamanKendaraan[status][{{ $aset->id }}]"
                                                                                class="form-select"
                                                                                style="height: 35px; width: 160px;"
                                                                                id="status_aset"
                                                                                aria-label="Default select example">

                                                                                @if ($aset->statusAset->id_status_aset == 2)
                                                                                    <option value="1"
                                                                                        {{ $aset->statusAset->id_status_aset == 1 ? 'selected' : '' }}>
                                                                                        Baik</option>
                                                                                    <option value="3"
                                                                                        {{ $aset->statusAset->id_status_aset == 3 ? 'selected' : '' }}>
                                                                                        Rusak</option>
                                                                                @endif
                                                                            </select>
                                                                        </td>
                                                                    @endif
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane show" id="aset_inventaris_ruangan">
                                        <div class="table-container">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">No</th>
                                                            <th scope="col">Kode Inventaris</th>
                                                            <th scope="col">Nama Inventaris Ruangan</th>
                                                            <th scope="col">Merk</th>
                                                            <th scope="col">Bahan</th>
                                                            <th scope="col">Jumlah</th>
                                                            @if (auth()->user()->hasRole('Petugas'))
                                                                @if ($peminjaman->status_verifikasi === 'Dikirim' || $peminjaman->status_verifikasi === 'ACC')
                                                                    <th scope="col">Status</th>
                                                                @endif
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($riwayatPeminjamanInventarisRuangan as $aset)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $aset->kode_aset }}</td>
                                                                <td>{{ $aset->nama }}</td>
                                                                <td>{{ $aset->merk }}</td>
                                                                <td>{{ $aset->bahan }}</td>
                                                                <td>{{ $aset->jumlah }}</td>
                                                                @if (auth()->user()->hasRole('Petugas'))
                                                                    @if ($peminjaman->status_verifikasi == 'Dikirim')
                                                                        <td>
                                                                            {{ $aset->statusAset->status_aset }}
                                                                        </td>
                                                                    @elseif ($peminjaman->status_verifikasi == 'ACC')
                                                                        <td>
                                                                            <select
                                                                                name="riwayatPeminjamanInventarisRuangan[status][{{ $aset->id }}]"
                                                                                class="form-select"
                                                                                style="height: 35px; width: 160px;"
                                                                                id="status_aset"
                                                                                aria-label="Default select example">

                                                                                @if ($aset->statusAset->id_status_aset == 2)
                                                                                    <option value="1"
                                                                                        {{ $aset->statusAset->id_status_aset == 1 ? 'selected' : '' }}>
                                                                                        Baik</option>
                                                                                    <option value="3"
                                                                                        {{ $aset->statusAset->id_status_aset == 3 ? 'selected' : '' }}>
                                                                                        Rusak</option>
                                                                                @endif
                                                                            </select>
                                                                        </td>
                                                                    @endif
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        document.getElementById('rejectButton').addEventListener('click', function() {
            Swal.fire({
                title: 'Tolak Peminjaman',
                input: 'textarea',
                inputAttributes: {
                    autocapitalize: 'off',
                    placeholder: 'Masukkan alasan penolakan...',
                },
                showCancelButton: true,
                confirmButtonText: 'Submit',
                showLoaderOnConfirm: true,
                preConfirm: async (alasanDitolak) => {
                    try {
                        const response = await fetch(
                            '{{ route('rejectPeminjaman', $peminjaman->id_peminjaman) }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                                body: JSON.stringify({
                                    alasan_ditolak: alasanDitolak,
                                }),
                            });

                        if (!response.ok) {
                            throw new Error(response.statusText);
                        }

                        return response.json();
                    } catch (error) {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Peminjaman Ditolak',
                        text: 'Peminjaman telah ditolak',
                        icon: 'error',
                    }).then(() => {
                        // Redirect ke halaman riwayat peminjaman setelah alert ditutup
                        window.location.href = '{{ route('riwayatPeminjaman') }}';
                    });
                }
            });
        });
    </script>
@endpush
