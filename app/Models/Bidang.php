<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_bidang';
    protected $table = 'bidang';
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class, 'id_bidang');
    }
}
