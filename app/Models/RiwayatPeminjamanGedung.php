<?php

namespace App\Models;

use App\Models\AsetGedung;
use App\Models\Peminjaman;
use App\Models\StatusAset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPeminjamanGedung extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_riwayat_peminjaman_gedung';
    protected $table = 'riwayat_peminjaman_gedung';
    protected $guarded = [];

    public function asetGedung()
    {
        return $this->belongsTo(AsetGedung::class, 'id_aset_gedung');
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
