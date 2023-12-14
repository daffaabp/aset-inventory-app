<form action="{{ route('bidang.destroy', $bidang->id_bidang) }}" method="POST">

    <a class="btn btn-warning me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" style="color: white;"
        href="{{ route('bidang.edit', $bidang->id_bidang) }}"><i class="fas fa-edit"></i></a>

    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-danger confirm-button" data-bs-toggle="tooltip" data-bs-placement="top"
        title="Hapus" nama="{{ $bidang->nama }}"><i class="fas fa-trash"></i></button>
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
