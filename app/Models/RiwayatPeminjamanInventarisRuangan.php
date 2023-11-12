<?php

namespace App\Models;

use App\Models\Ruangan;
use App\Models\Peminjaman;
use App\Models\StatusAset;
use App\Models\AsetInventarisRuangan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatPeminjamanInventarisRuangan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_riwayat_peminjaman_inventaris_ruangan';
    protected $table = 'riwayat_peminjaman_inventaris_ruangan';
    protected $guarded = [];

    public function asetInventarisRuangan()
    {
        return $this->belongsTo(AsetInventarisRuangan::class, 'id_aset_inventaris_ruangan');
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }

    public function statusAset()
    {
        return $this->belongsTo(StatusAset::class, 'id_status_aset', 'id_status_aset');
    }

    public function kodeRuangan()
    {
        return $this->belongsTo(Ruangan::class, 'kode_ruangan', 'kode_ruangan');
    }
}