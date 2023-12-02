<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Aset Kendaraan PDF</title>
    <style>
        body {
            margin: 0;
        }

        @page {
            size: F4;
            margin: 0;
        }

        * {
            margin: 0;
            padding: 0;
            font-size: 8.4px;
        }

        .page {
            padding: 30px 20px;
            margin: 0;
        }

        #table {
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #DDD;
            padding: 3px;
        }

        #table th {
            padding-top: 5px;
            padding-bottom: 5px;
            text-align: center;
            background-color: #EEEEEE;
            color: black;
        }
    </style>

</head>

<body>
    <div class="page">
        <p style="text-align: center;"><b><u style="font-size: 12px;">DAFTAR INVENTARIS BARANG</u></b></p>
        <br>
        <p style="text-align: center; font-size: 12px; margin-top: -10px;">III. KENDARAAN BERMOTOR</p>

        <table border="0" cellspacing="3" cellpadding="0">
            <tr>
                <td>PROVINSI</td>
                <td> :</td>
                <td>JAWA TENGAH</td>
            </tr>
            <tr>
                <td>KABUPATEN</td>
                <td> :</td>
                <td>BANYUMAS</td>
            </tr>
            <tr>
                <td>UNIT</td>
                <td> :</td>
                <td>KWARCAB BANYUMAS</td>
            </tr>
            <tr>
                <td>SATUAN</td>
                <td> :</td>
                <td>KWARCAB BANYUMAS</td>
            </tr>
        </table>
        <br>

        <table id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Status</th>
                    <th>Kode</th>
                    <th>Nama</th>
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
                </tr>
            </thead>
            <tbody>
                @foreach ($aset_kendaraan as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->statusAset->status_aset }}</td>
                        <td>{{ $row->kode_aset }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->tanggal_inventarisir)->isoFormat('D MMMM Y') }}</td>
                        <td>{{ $row->merk }}</td>
                        <td>{{ $row->type }}</td>
                        <td>{{ $row->cylinder }}</td>
                        <td>{{ $row->warna }}</td>
                        <td>{{ $row->no_rangka }}</td>
                        <td>{{ $row->no_mesin }}</td>
                        <td>{{ $row->thn_pembuatan }}</td>
                        <td>{{ $row->thn_pembelian }}</td>
                        <td>{{ $row->no_polisi }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->tgl_bpkb)->isoFormat('D MMMM Y') }}</td>
                        <td>{{ $row->no_bpkb }}</td>
                        <td>{{ formatRupiah($row->harga, true) }}</td>
                        <td>{{ $row->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>

</html>
