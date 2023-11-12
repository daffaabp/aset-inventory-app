<?php

namespace App\Models;

use App\Models\Ruangan;
use App\Models\StatusAset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsetInventarisRuangan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_aset_inventaris_ruangan';
    protected $table = 'aset_inventaris_ruangan';
    protected $guarded = [];

    public function statusAset()
    {
        return $this->belongsTo(StatusAset::class, 'id_status_aset', 'id_status_aset');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'kode_ruangan', 'kode_ruangan');
    }
}
