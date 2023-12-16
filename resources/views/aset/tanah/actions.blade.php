<form action="{{ route('tanah.destroy', $asetTanah->id_aset_tanah) }}" method="POST">
    <button type="button" class="btn btn-primary btn-md me-2 show-detail-btn" data-bs-toggle="modal"
        data-bs-target="#show-detail" data-id="{{ $asetTanah->id_aset_tanah }}">
        <i class="fas fa-eye"></i>
    </button>

    <a class="btn btn-warning me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" style="color: white;"
        href="{{ route('tanah.edit', encrypt($asetTanah->id_aset_tanah)) }}"><i class="fas fa-edit"></i></a>

    @csrf
    @method('DELETE')

    <button type="button" class="btn btn-danger confirm-button" data-bs-toggle="tooltip" data-bs-placement="top"
        title="Hapus" nama="{{ $asetTanah->nama }}"><i class="fas fa-trash"></i></button>
</form>

{{-- Modal SHOW DETAIL ASET --}}
<div id="show-detail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Detail Aset Tanah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="bg-light py-1" scope="row" style="width: 120px;">Status Aset</th>
                            <td style="width: 5px">:</td>
                            <td id="status_aset"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Kode</th>
                            <td>:</td>
                            <td id="kode_aset"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Nama Tanah</th>
                            <td>:</td>
                            <td id="nama"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Tanggal Inventarisir</th>
                            <td>:</td>
                            <td id="tanggal_inventarisir"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Luas (m<sup>2</sup>)</th>
                            <td>:</td>
                            <td id="luas"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Letak Tanah</th>
                            <td>:</td>
                            <td id="letak_tanah"></td>
                        </tr>
                        <tr>
                            <th class="bg-light" scope="row">Penggunaan</th>
                            <td>:</td>
                            <td id="penggunaan"></td>
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

{{-- Sweet Alert Untuk Delete Aset --}}
<script type="text/javascript">
    $('.confirm-button').click(function(e) {
        var form = $(this).closest("form");
        var nama = $(this).attr('nama')
        e.preventDefault();

        Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Apakah anda yakin akan menghapus data bidang " + '"' + nama + '"' + " ?",
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
        var asetTanahId = $(this).data('id');

        $.ajax({
            url: "{{ route('tanah.showDetail') }}",
            method: 'GET',
            data: {
                id: asetTanahId
            },
            success: function(response) {
                $('#status_aset').text(response.status_aset);
                $('#kode_aset').text(response.kode_aset);
                $('#tanggal_inventarisir').text(response.tanggal_inventarisir);
                $('#nama').text(response.nama);
                $('#luas').text(response.luas);
                $('#letak_tanah').text(response.letak_tanah);
                $('#penggunaan').text(response.penggunaan);
                $('#harga').text(response.harga);
                $('#keterangan').text(response.keterangan);
            },
            error: function(error) {
                console.log('Error fetching Aset Tanah details:', error);
            }
        });
    });
</script>
