<?php

namespace App\Models;

use App\Models\AsetTanah;
use App\Models\AsetGedung;
use App\Models\AsetKendaraan;
use App\Models\AsetInventarisRuangan;
use App\Models\RiwayatPeminjamanTanah;
use App\Models\RiwayatPeminjamanGedung;
use Illuminate\Database\Eloquent\Model;
use App\Models\RiwayatPeminjamanKendaraan;
use App\Models\RiwayatPeminjamanInventarisRuangan;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusAset extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_status_aset';
    protected $table = 'status_aset';
    protected $guarded = [];

    public function asetTanah()
    {
        return $this->hasMany(AsetTanah::class, 'id_status_aset', 'id_status_aset');
    }

    public function asetGedung()
    {
        return $this->hasMany(AsetGedung::class, 'id_status_aset', 'id_status_aset');
    }

    public function asetKendaraan()
    {
        return $this->hasMany(AsetKendaraan::class, 'id_status_aset', 'id_status_aset');
    }

    public function asetInventarisRuangan()
    {
        return $this->hasMany(AsetInventarisRuangan::class, 'id_status_aset', 'id_status_aset');
    }

    public function riwayatPeminjamanTanah()
    {
        return $this->hasMany(RiwayatPeminjamanTanah::class, 'id_status_aset', 'id_status_aset');
    }

    public function riwayatPeminjamanGedung()
    {
        return $this->hasMany(RiwayatPeminjamanGedung::class, 'id_status_aset', 'id_status_aset');
    }

    public function riwayatPeminjamanKendaraan()
    {
        return $this->hasMany(RiwayatPeminjamanKendaraan::class, 'id_status_aset', 'id_status_aset');
    }

    public function riwayatPeminjamanInventarisRuangan()
    {
        return $this->hasMany(RiwayatPeminjamanInventarisRuangan::class, 'id_status_aset', 'id_status_aset');
    }
}
