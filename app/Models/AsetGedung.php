<?php

namespace App\Models;

use App\Models\StatusAset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AsetGedung extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_aset_gedung';
    protected $table = 'aset_gedung';
    protected $guarded = [];

    public function statusAset()
    {
        return $this->belongsTo(StatusAset::class, 'id_status_aset', 'id_status_aset');
    }
}