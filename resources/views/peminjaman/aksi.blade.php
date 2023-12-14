@can('verifikasiPeminjamanDetails')
    <td>
        <form action="{{ route('verifikasiPeminjamanDetails', $peminjaman->id_peminjaman) }}">
            <button type="submit" class="btn btn-primary">Lihat</button>
        </form>
    </td>
@endcan
