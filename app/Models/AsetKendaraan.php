<?php

namespace App\Models;

use App\Models\StatusAset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AsetKendaraan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_aset_kendaraan';
    protected $table = 'aset_kendaraan';
    protected $guarded = [];

    public function statusAset()
    {
        return $this->belongsTo(StatusAset::class, 'id_status_aset', 'id_status_aset');
    }
}
