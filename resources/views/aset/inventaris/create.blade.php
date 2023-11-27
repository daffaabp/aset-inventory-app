@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tambah Aset Inventaris Ruangan</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Tambah Aset Inventaris Ruangan</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="justify-center card-title">Data Aset Inventaris</h5>
                                <div class="form-group">
                                    <label>Status Inventaris</label>
                                    <select name="id_status_aset" class="form-select">
                                        <option selected disabled> --Pilih Status-- </option>
                                        @foreach ($status_aset as $row)
                                            <option value="{{ $row->id_status_aset }}"
                                                {{ $row->id_status_aset == 1 ? 'selected' : '' }}>{{ $row->status_aset }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ruangan</label>
                                    <select name="kode_ruangan" class="form-select">
                                        <option selected disabled> --Pilih Ruangan-- </option>
                                        @foreach ($ruangan as $row)
                                            <option value="{{ $row->kode_ruangan }}">{{ $row->nama }} -
                                                ({{ $row->kode_ruangan }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Inventarisir</label>
                                    <input type="date" class="form-control" name="tanggal_inventarisir"
                                        value="{{ \Carbon\Carbon::now()->toDateString() }}" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" autocomplete="off" autofocus>
                                </div>

                                <input type="hidden" class="form-control" name="grup_id" value="">

                            </div>

                            <div class="col-md-6">
                                <h5 class="card-title">Bahan dan Kegunaan</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Merk</label>
                                            <input type="text" class="form-control" name="merk" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Volume</label>
                                            <input type="text" class="form-control" name="volume" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bahan</label>
                                            <input type="text" class="form-control" name="bahan" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <input type="number" class="form-control" name="tahun" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="number" class="form-control" name="harga" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text" class="form-control" name="keterangan" autocomplete="off"
                                                autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{-- <label>Jumlah</label> --}}
                                            <input type="hidden" class="form-control" name="jumlah" value="1">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
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
