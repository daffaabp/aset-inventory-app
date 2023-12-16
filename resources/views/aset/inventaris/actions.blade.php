<form action="{{ route('inventaris.destroy', $inventaris->id_aset_inventaris_ruangan) }}" method="POST">
    <button type="button" class="btn btn-primary btn-md me-2 show-detail-btn" data-bs-toggle="modal"
        data-bs-target="#show-detail" data-id="{{ $inventaris->id_aset_inventaris_ruangan }}">
        <i class="fas fa-eye"></i>
    </button>

    <a class="btn btn-warning me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" style="color: white;"
        href="{{ route('inventaris.edit', encrypt($inventaris->id_aset_inventaris_ruangan)) }}"><i
            class="fas fa-edit"></i></a>

    @csrf
    @method('DELETE')

    <button type="button" class="btn btn-danger confirm-button" data-bs-toggle="tooltip" data-bs-placement="top"
        title="Hapus" nama="{{ $inventaris->nama }}"><i class="fas fa-trash"></i></button>
</form>

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
                            <th class="bg-light" scope="row">Nama Inventaris</th>
                            <td>:</td>
                            <td id="nama"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Ruangan</th>
                            <td>:</td>
                            <td id="ruangan"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Merk</th>
                            <td>:</td>
                            <td id="merk"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Volume</th>
                            <td>:</td>
                            <td id="volume"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Bahan</th>
                            <td>:</td>
                            <td id="bahan"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Tahun</th>
                            <td>:</td>
                            <td id="tahun"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Harga</th>
                            <td>:</td>
                            <td id="harga"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Jumlah</th>
                            <td>:</td>
                            <td id="jumlah"></td>
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
        var inventarisId = $(this).data('id');

        $.ajax({
            url: "{{ route('inventaris.showDetail') }}",
            method: 'GET',
            data: {
                id: inventarisId
            },
            success: function(response) {
                $('#status_aset').text(response.status_aset);
                $('#kode_aset').text(response.kode_aset);
                $('#tanggal_inventarisir').text(response.tanggal_inventarisir);
                $('#nama').text(response.nama);
                $('#ruangan').text(response.ruangan);
                $('#merk').text(response.merk);
                $('#volume').text(response.volume);
                $('#bahan').text(response.bahan);
                $('#tahun').text(response.tahun);
                $('#harga').text(response.harga);
                $('#jumlah').text(response.jumlah);
                $('#keterangan').text(response.keterangan);
            },
            error: function(error) {
                console.log('Error fetching Aset Tanah details:', error);
            }
        });
    });
</script>
