<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Aset Inventaris Ruangan PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
        <h1 style="font-size: 20px; text-align: center;">Data Aset Inventaris Ruangan</h1>

        <table id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Status Aset</th>
                    <th>Kode Aset</th>
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
                @foreach ($aset_inventaris as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->statusAset->status_aset }}</td>
                        <td>{{ $row->kode_aset }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->tanggal_inventarisir)->isoFormat('D MMMM Y') }}</td>
                        <td>{{ $row->merk }}</td>
                        <td>{{ $row->volume }}</td>
                        <td>{{ $row->bahan }}</td>
                        <td>{{ $row->tahun }}</td>
                        <td>{{ formatRupiah($row->harga, true) }}</td>
                        <td>{{ $row->jumlah }}</td>
                        <td>{{ $row->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
