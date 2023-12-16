<form action="{{ route('kendaraan.destroy', $asetKendaraan->id_aset_kendaraan) }}" method="POST">
    <button type="button" class="btn btn-primary btn-md me-2 show-detail-btn" data-bs-toggle="modal"
        data-bs-target="#show-detail" data-id="{{ $asetKendaraan->id_aset_kendaraan }}">
        <i class="fas fa-eye"></i>
    </button>

    <a class="btn btn-warning me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" style="color: white;"
        href="{{ route('kendaraan.edit', encrypt($asetKendaraan->id_aset_kendaraan)) }}"><i class="fas fa-edit"></i></a>

    @csrf
    @method('DELETE')

    <button type="button" class="btn btn-danger confirm-button" data-bs-toggle="tooltip" data-bs-placement="top"
        title="Hapus" nama="{{ $asetKendaraan->nama }}"><i class="fas fa-trash"></i></button>
</form>

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

{{-- Modal SHOW DETAIL ASET --}}
<div id="show-detail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header sticky-header-footer">
                <h5 class="modal-title" id="modalTitle">Detail Aset Kendaraan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="bg-light" scope="row" style="width: 120px">Status Aset</th>
                            <td style="width: 5px">:</td>
                            <td id="status_aset"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Kode</th>
                            <td>:</td>
                            <td id="kode_aset"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Tanggal Inventarisir</th>
                            <td>:</td>
                            <td id="tanggal_inventarisir"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Jenis Kendaraan</th>
                            <td>:</td>
                            <td id="nama"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Merk</th>
                            <td>:</td>
                            <td id="merk"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Type</th>
                            <td>:</td>
                            <td id="type"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Cylinder</th>
                            <td>:</td>
                            <td id="cylinder"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Warna</th>
                            <td>:</td>
                            <td id="warna"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Nomor Rangka</th>
                            <td>:</td>
                            <td id="no_rangka"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Nomor Mesin</th>
                            <td>:</td>
                            <td id="no_mesin"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Tahun Pembuatan</th>
                            <td>:</td>
                            <td id="thn_pembuatan"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Tahun Pembelian</th>
                            <td>:</td>
                            <td id="thn_pembelian"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Nomor Polisi</th>
                            <td>:</td>
                            <td id="no_polisi"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Tanggal BPKB</th>
                            <td>:</td>
                            <td id="tgl_bpkb"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Nomor BPKB</th>
                            <td>:</td>
                            <td id="no_bpkb"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Harga</th>
                            <td>:</td>
                            <td id="harga"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Keterangan</th>
                            <td>:</td>
                            <td id="keterangan"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.confirm-button').click(function(e) {
        var form = $(this).closest("form");
        var nama = $(this).attr('nama')
        e.preventDefault();

        Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Apakah anda yakin akan menghapus aset " + '"' + nama + '"' + " ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                        'Berhasil dihapus!',
                        'Data kamu berhasil dihapus.',
                        'success'
                    )
                }
            })
    });
</script>


{{-- Ajax untuk Show Detail --}}
<script type="text/javascript">
    $('.show-detail-btn').click(function() {
        var asetKendaraanId = $(this).data('id');

        $.ajax({
            url: "{{ route('kendaraan.showDetail') }}",
            method: 'GET',
            data: {
                id: asetKendaraanId
            },
            success: function(response) {
                $('#status_aset').text(response.status_aset);
                $('#kode_aset').text(response.kode_aset);
                $('#tanggal_inventarisir').text(response.tanggal_inventarisir);
                $('#nama').text(response.nama);
                $('#merk').text(response.merk);
                $('#type').text(response.type);
                $('#cylinder').text(response.cylinder);
                $('#warna').text(response.warna);
                $('#no_rangka').text(response.no_rangka);
                $('#no_mesin').text(response.no_mesin);
                $('#thn_pembuatan').text(response.thn_pembuatan);
                $('#thn_pembelian').text(response.thn_pembelian);
                $('#no_polisi').text(response.no_polisi);
                $('#tgl_bpkb').text(response.tgl_bpkb);
                $('#no_bpkb').text(response.no_bpkb);
                $('#harga').text(response.harga);
                $('#keterangan').text(response.keterangan);
            },
            error: function(error) {
                console.log('Error fetching Aset Tanah details:', error);
            }
        });
    });
</script>
