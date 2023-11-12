<?php

namespace App\Models;

use App\Models\AsetTanah;
use App\Models\Peminjaman;
use App\Models\StatusAset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPeminjamanTanah extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_riwayat_peminjaman_tanah';
    protected $table = 'riwayat_peminjaman_tanah';
    protected $guarded = [];

    public function asetTanah()
    {
        return $this->belongsTo(AsetTanah::class, 'id_aset_tanah');
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }

    public function statusAset()
    {
        return $this->belongsTo(StatusAset::class, 'id_status_aset', 'id_status_aset');
    }
}
