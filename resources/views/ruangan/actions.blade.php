<form action="{{ route('ruangan.destroy', $ruang->kode_ruangan) }}" method="POST">
    <a class="btn btn-warning me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" style="color: white;"
        href="{{ route('ruangan.edit', $ruang->kode_ruangan) }}"><i class="fas fa-edit"></i></a>

    @csrf
    @method('DELETE')

    <button type="button" class="btn btn-danger confirm-button" data-bs-toggle="tooltip" data-bs-placement="top"
        title="Hapus" nama="{{ $ruang->nama }}"><i class="fas fa-trash"></i></button>
</form>

<script type="text/javascript">
    $('.confirm-button').click(function(e) {
        var form = $(this).closest("form");
        var nama = $(this).attr('nama')
        e.preventDefault();

        Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Apakah anda yakin akan menghapus ruangan " + '"' + nama + '"' + " ?",
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
                }
            })
            .catch((error) => {
                // Jika terjadi kesalahan saat penghapusan
                Swal.fire(
                    'Error',
                    'Terjadi kesalahan saat menghapus data. Silakan coba lagi.',
                    'error'
                );
            });
    });
</script>
