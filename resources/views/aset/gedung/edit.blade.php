@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Ubah Aset Gedung</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Ubah Aset Gedung</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST"
                        action="{{ route('gedung.update', $aset_gedung->id_aset_gedung) }}"enctype="multipart/form-data"
                        id="number-format">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="justify-center card-title">Data Gedung</h5>
                                <input type="hidden" name="id_aset_gedung" value="{{ $aset_gedung->id_aset_gedung }}">
                                <div class="form-group">
                                    <label>Status Aset</label>
                                    <select name="id_status_aset"
                                        class="form-select @error('status_aset') is-invalid @enderror" id="id_status_aset">
                                        <option selected disabled> --Pilih Status--</option>
                                        @foreach ($status_aset as $row)
                                            <option value="{{ $row->id_status_aset }}"
                                                {{ (old('id_status_aset') ? old('id_status_aset') : $aset_gedung->id_status_aset) == $row->id_status_aset ? 'selected' : '' }}>
                                                {{ $row->status_aset }}</option>
                                        @endforeach
                                    </select>
                                    @error('status_aset')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kode</label>
                                    <input type="text" class="form-control" name="kode_aset" readonly
                                        value="{{ $aset_gedung->kode_aset }}">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Inventarisir</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_inventarisir') is-invalid @enderror"
                                        name="tanggal_inventarisir" autocomplete="off"
                                        value="{{ old('tanggal_inventarisir', $aset_gedung->tanggal_inventarisir) }}">
                                    @error('tanggal_inventarisir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Gedung</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        name="nama" autocomplete="off" value="{{ old('nama', $aset_gedung->nama) }}">
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kondisi</label>
                                            <select name="kondisi" value="{{ old('kondisi', $aset_gedung->kondisi) }}"
                                                class="form-control form-select @error('kondisi') is-invalid @enderror"
                                                autocomplete="off" autofocus>
                                                <option value="Baik" @if (old('kondisi') == 'Baik') selected @endif>
                                                    Baik
                                                </option>
                                                <option value="Rusak" @if (old('kondisi') == 'Rusak') selected @endif>
                                                    Rusak
                                                </option>
                                                <option value="Korosi" @if (old('kondisi') == 'Korosi') selected @endif>
                                                    Korosi
                                                </option>
                                                <option value="Baru" @if (old('kondisi') == 'Baru') selected @endif>
                                                    Baru
                                                </option>
                                            </select>
                                            @error('kondisi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bertingkat</label>
                                            <select name="bertingkat"
                                                value="{{ old('bertingkat', $aset_gedung->bertingkat) }}"
                                                class="form-control form-select @error('bertingkat') is-invalid @enderror">
                                                <option value="Tidak" @if (old('bertingkat') == 'Tidak') selected @endif>
                                                    Tidak</option>
                                                <option value="Ya" @if (old('bertingkat') == 'Ya') selected @endif>Ya
                                                </option>
                                            </select>
                                            @error('bertingkat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Beton</label>
                                            <select name="beton" value="{{ old('beton', $aset_gedung->beton) }}"
                                                class="form-control form-select @error('beton') is-invalid @enderror">
                                                <option value="Beton" @if (old('beton') == 'Beton') selected @endif>
                                                    Beton</option>
                                                <option value="Besi Beton"
                                                    @if (old('beton') == 'Besi Beton') selected @endif>Besi Beton</option>
                                                <option value="Besi" @if (old('beton') == 'Besi') selected @endif>
                                                    Besi</option>
                                                <option value="Aspal" @if (old('beton') == 'Aspal') selected @endif>
                                                    Aspal</option>
                                                <option value="Kayu" @if (old('beton') == 'Kayu') selected @endif>
                                                    Kayu</option>
                                            </select>
                                            @error('beton')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Luas Lantai (m<sup>2</sup>) <span class="login-danger"
                                                    style="font-size: 12px;">*opsional</span></label>
                                            <input type="text"
                                                class="form-control @error('luas_lantai') is-invalid @enderror"
                                                name="luas_lantai" autocomplete="off"
                                                value="{{ old('luas_lantai', $aset_gedung->luas_lantai) }}">
                                            @error('luas_lantai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <h5 class="card-title">Dokumen dan Kegunaan</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <input type="text"
                                                class="form-control @error('lokasi') is-invalid @enderror" name="lokasi"
                                                autocomplete="off" value="{{ old('lokasi', $aset_gedung->lokasi) }}">
                                            @error('lokasi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tahun Dokumen</label>
                                            <input type="text"
                                                class="form-control @error('tahun_dok') is-invalid @enderror"
                                                name="tahun_dok" autocomplete="off"
                                                value="{{ old('tahun_dok', $aset_gedung->tahun_dok) }}">
                                            @error('tahun_dok')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor Dokumen</label>
                                            <input type="text"
                                                class="form-control @error('nomor_dok') is-invalid @enderror"
                                                name="nomor_dok" autocomplete="off"
                                                value="{{ old('nomor_dok', $aset_gedung->nomor_dok) }}">
                                            @error('nomor_dok')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Luas (m<sup>2</sup>) <span class="login-danger"
                                                    style="font-size: 12px;">*opsional</span></label>
                                            <input type="text"
                                                class="form-control @error('luas') is-invalid @enderror" name="luas"
                                                autocomplete="off" value="{{ old('luas', $aset_gedung->luas) }}">
                                            @error('luas')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Hak Guna Bangunan</label>
                                            <select name="hak" value="{{ old('hak', $aset_gedung->hak) }}"
                                                class="form-control form-select @error('hak') is-invalid @enderror">
                                                <option value="HGB" @if (old('hak') == 'HGB') selected @endif>
                                                    HGB</option>
                                                <option value="Milik" @if (old('hak') == 'Milik') selected @endif>
                                                    Milik</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="text" id="dengan-rupiah"
                                                class="form-control @error('harga') is-invalid @enderror" name="harga"
                                                autocomplete="off" value="{{ old('harga', $aset_gedung->harga) }}">
                                            @error('harga')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" rows="4" cols="4"
                                                class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukkan Keterangan...">{{ old('keterangan', $aset_gedung->keterangan) }}</textarea>
                                            @error('keterangan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-start">
                            <a href="{{ route('gedung.index') }}" class="btn btn-secondary me-1"><i
                                    class="fas fa-arrow-left"></i>
                                Kembali</a>
                        </div>

                        <div class="text-end" style="margin-top: -38px;">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function convertToNumber(rupiah) {
            return parseInt(rupiah.replace(/[^\d]/g, ''), 10) || 0;
        }

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? prefix + rupiah : '');
        }

        var inputHarga = document.getElementById('dengan-rupiah');

        inputHarga.addEventListener('input', function(e) {
            this.value = formatRupiah(this.value, 'Rp. ');
        });

        var form = document.getElementById('number-format');
        form.addEventListener('submit', function(e) {
            inputHarga.value = convertToNumber(inputHarga.value);
        });
    </script>
@endpush
