<?php

namespace App\Models;

use App\Models\AsetInventarisRuangan;
use Illuminate\Database\Eloquent\Model;
use App\Models\RiwayatPeminjamanInventarisRuangan;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruangan extends Model
{
    use HasFactory;
    protected $primaryKey = 'kode_ruangan';
    protected $keyType = 'string';
    protected $table = 'ruangan';
    protected $guarded = [];


    // public function asetInventa()
    // {
    //     return $this->belongsTo(StatusAset::class, 'id_status_aset', 'id_status_aset');
    // }

    public function asetInventarisRuangan()
    {
        return $this->hasMany(AsetInventarisRuangan::class, 'kode_ruangan', 'kode_ruangan');
    }

    public function riwayatPeminjamanInventarisRuangan()
    {
        return $this->hasMany(RiwayatPeminjamanInventarisRuangan::class, 'kode_ruangan', 'kode_ruangan');
    }
}
