<form action="{{ route('gedung.destroy', $asetGedung->id_aset_gedung) }}" method="POST">
    <button type="button" class="btn btn-primary btn-md me-2 show-detail-btn" data-bs-toggle="modal"
        data-bs-target="#show-detail" data-id="{{ $asetGedung->id_aset_gedung }}">
        <i class="fas fa-eye"></i>
    </button>

    <a class="btn btn-warning me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" style="color: white;"
        href="{{ route('gedung.edit', encrypt($asetGedung->id_aset_gedung)) }}"><i class="fas fa-edit"></i></a>

    @csrf
    @method('DELETE')

    <button type="button" class="btn btn-danger confirm-button" data-bs-toggle="tooltip" data-bs-placement="top"
        title="Hapus" nama="{{ $asetGedung->nama }}"><i class="fas fa-trash"></i></button>
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
                <h5 class="modal-title" id="modalTitle">Detail Aset Gedung</h5>
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
                            <th class="bg-light" scope="row">Nama Gedung</th>
                            <td>:</td>
                            <td id="nama"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Kondisi</th>
                            <td>:</td>
                            <td id="kondisi"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Bertingkat</th>
                            <td>:</td>
                            <td id="bertingkat"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Beton</th>
                            <td>:</td>
                            <td id="beton"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Luas Lantai (m<sup>2</sup>)</th>
                            <td>:</td>
                            <td id="luas_lantai"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Lokasi</th>
                            <td>:</td>
                            <td id="lokasi"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Tahun Dokumen</th>
                            <td>:</td>
                            <td id="tahun_dok"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Nomor Dokumen</th>
                            <td>:</td>
                            <td id="nomor_dok"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Luas (m<sup>2</sup>)</th>
                            <td>:</td>
                            <td id="luas"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Hak</th>
                            <td>:</td>
                            <td id="hak"></td>
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
        var asetGedungId = $(this).data('id');

        $.ajax({
            url: "{{ route('gedung.showDetail') }}",
            method: 'GET',
            data: {
                id: asetGedungId
            },
            success: function(response) {
                $('#status_aset').text(response.status_aset);
                $('#kode_aset').text(response.kode_aset);
                $('#tanggal_inventarisir').text(response.tanggal_inventarisir);
                $('#nama').text(response.nama);
                $('#kondisi').text(response.kondisi);
                $('#bertingkat').text(response.bertingkat);
                $('#beton').text(response.beton);
                $('#luas_lantai').text(response.luas_lantai);
                $('#lokasi').text(response.lokasi);
                $('#tahun_dok').text(response.tahun_dok);
                $('#nomor_dok').text(response.nomor_dok);
                $('#luas').text(response.luas);
                $('#hak').text(response.hak);
                $('#harga').text(response.harga);
                $('#keterangan').text(response.keterangan);
            },
            error: function(error) {
                console.log('Error fetching Aset Tanah details:', error);
            }
        });
    });
</script>
