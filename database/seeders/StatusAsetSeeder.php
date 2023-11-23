<?php

namespace Database\Seeders;

use App\Models\StatusAset;
use Illuminate\Database\Seeder;

class StatusAsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status_aset = [
            [
                'status_aset' => 'Tersedia',
            ],
            [
                'status_aset' => 'Dipinjam',
            ],
            [
                'status_aset' => 'Rusak',
            ],
        ];
        StatusAset::insert($status_aset);
    }
}
