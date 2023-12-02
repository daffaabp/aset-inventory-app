<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Aset Inventaris Ruangan PDF</title>
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
            font-size: 8.6px;
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
        <p style="text-align: center; font-size: 12px; margin-top: -10px;">IV. INVENTARIS RUANGAN</p>

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
                    <th>Status Aset</th>
                    <th>Kode Aset</th>
                    <th>Nama Ruangan</th>
                    <th>Nama</th>
                    <th>Tanggal Inventarisir</th>
                    <th>Merk</th>
                    <th>Volume</th>
                    <th>Bahan</th>
                    <th>Tahun</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groupedAsets as $grupId => $asets)
                    @if ($grupId)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $asets->first()->statusAset->status_aset }}</td>
                            <td>{{ $asets->first()->kode_aset . ' - ' . $asets->last()->kode_aset }}</td>
                            <td>{{ $asets->first()->ruangan->nama }}</td>
                            <td>{{ $asets->first()->nama }}</td>
                            <td>{{ $asets->first()->tanggal_inventarisir }}</td>
                            <td>{{ $asets->first()->merk }}</td>
                            <td>{{ $asets->first()->volume }}</td>
                            <td>{{ $asets->first()->bahan }}</td>
                            <td>{{ $asets->first()->tahun }}</td>
                            <td>{{ $asets->first()->harga }}</td>
                            <td>{{ $asets->sum('jumlah') }}</td>
                            <td>{{ $asets->first()->keterangan }}</td>
                        </tr>
                    @else
                        @foreach ($asets as $aset)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $aset->statusAset->status_aset }}</td>
                                <td>{{ $aset->kode_aset }}</td>
                                <td>{{ $aset->ruangan->nama }}</td>
                                <td>{{ $aset->nama }}</td>
                                <td>{{ $aset->tanggal_inventarisir }}</td>
                                <td>{{ $aset->merk }}</td>
                                <td>{{ $aset->volume }}</td>
                                <td>{{ $aset->bahan }}</td>
                                <td>{{ $aset->tahun }}</td>
                                <td>{{ $aset->harga }}</td>
                                <td>{{ $aset->jumlah }}</td>
                                <td>{{ $aset->keterangan }}</td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            </tbody>
        </table>

    </div>

</body>

</html>
