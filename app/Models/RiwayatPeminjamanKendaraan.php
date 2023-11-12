<?php

namespace App\Models;

use App\Models\AsetKendaraan;
use App\Models\Peminjaman;
use App\Models\StatusAset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPeminjamanKendaraan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_riwayat_peminjaman_kendaraan';
    protected $table = 'riwayat_peminjaman_kendaraan';
    protected $guarded = [];

    public function asetKendaraan()
    {
        return $this->belongsTo(AsetKendaraan::class, 'id_aset_kendaraan');
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
