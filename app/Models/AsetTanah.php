<?php

namespace App\Models;

use App\Models\StatusAset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsetTanah extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_aset_tanah';
    protected $table = 'aset_tanah';
    protected $guarded = [];

    public function statusAset()
    {
        return $this->belongsTo(StatusAset::class, 'id_status_aset', 'id_status_aset');
    }
}
