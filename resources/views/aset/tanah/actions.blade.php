<form action="{{ route('tanah.destroy', $asetTanah->id_aset_tanah) }}" method="POST">
    <a class="btn btn-primary me-2" style="color: white;"
        href="{{ route('tanah.edit', $asetTanah->id_aset_tanah) }}">Edit</a>

    @csrf
    @method('DELETE')

    <button type="button" class="btn btn-danger confirm-button" nama="{{ $asetTanah->nama }}">Hapus</button>
</form>

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
                cancelButtonText: 'Batal'
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
