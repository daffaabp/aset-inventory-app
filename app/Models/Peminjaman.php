<?php

namespace App\Models;

use App\Models\User;
use App\Models\RiwayatPeminjamanTanah;
use App\Models\RiwayatPeminjamanGedung;
use Illuminate\Database\Eloquent\Model;
use App\Models\RiwayatPeminjamanKendaraan;
use App\Models\RiwayatPeminjamanInventarisRuangan;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_peminjaman';
    protected $table = 'peminjaman';
    protected $guarded = [];

    public function usersPeminjam()
    {
        return $this->belongsTo(User::class, 'id_peminjam');
    }

    public function usersPetugas()
    {
        return $this->belongsTo(User::class, 'id_petugas');
    }

    public function riwayatPeminjamanTanah()
    {
        return $this->hasMany(RiwayatPeminjamanTanah::class, 'id_peminjaman', 'id_peminjaman');
    }

    public function riwayatPeminjamanGedung()
    {
        return $this->hasMany(RiwayatPeminjamanGedung::class, 'id_peminjaman', 'id_peminjaman');
    }

    public function riwayatPeminjamanKendaraan()
    {
        return $this->hasMany(RiwayatPeminjamanKendaraan::class, 'id_peminjaman', 'id_peminjaman');
    }

    public function riwayatPeminjamanInventarisRuangan()
    {
        return $this->hasMany(RiwayatPeminjamanInventarisRuangan::class, 'id_peminjaman', 'id_peminjaman');
    }
}