<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ruangan = [
            [
                'kode_ruangan' => 'A',
                'nama' => 'Paseban Bintang',
                'lokasi' => 'Kwarcab Banyumas',
            ],

            [
                'kode_ruangan' => 'B',
                'nama' => 'Sekretariat',
                'lokasi' => 'Kwarcab Banyumas',
            ],

            [
                'kode_ruangan' => 'C',
                'nama' => 'Graha Bina Satria',
                'lokasi' => 'Kwarcab Banyumas',
            ],

            [
                'kode_ruangan' => 'D',
                'nama' => 'Pendopo Tunas Kencana',
                'lokasi' => 'Kwarcab Banyumas',
            ],

            [
                'kode_ruangan' => 'E',
                'nama' => 'Komputer',
                'lokasi' => 'Kwarcab Banyumas',
            ],

            [
                'kode_ruangan' => 'F',
                'nama' => 'Humas Studio',
                'lokasi' => 'Kwarcab Banyumas',
            ],

            [
                'kode_ruangan' => 'G',
                'nama' => 'DKC',
                'lokasi' => 'Kwarcab Banyumas',
            ],

            [
                'kode_ruangan' => 'H',
                'nama' => 'Dapur',
                'lokasi' => 'Kwarcab Banyumas',
            ],

            [
                'kode_ruangan' => 'I',
                'nama' => 'Pusdiklat Kendalisada',
                'lokasi' => 'Kwarcab Banyumas',
            ],

            [
                'kode_ruangan' => 'J',
                'nama' => 'Gudang Pusdiklatcab',
                'lokasi' => 'Kwarcab Banyumas',
            ],

            [
                'kode_ruangan' => 'K',
                'nama' => 'Mushola',
                'lokasi' => 'Kwarcab Banyumas',
            ],

            [
                'kode_ruangan' => 'L',
                'nama' => 'Perpustakaan',
                'lokasi' => 'Kwarcab Banyumas',
            ],

            [
                'kode_ruangan' => 'M',
                'nama' => 'Koperasi - Kedai',
                'lokasi' => 'Kwarcab Banyumas',
            ],

            [
                'kode_ruangan' => 'O',
                'nama' => 'Gudang Arsip',
                'lokasi' => 'Kwarcab Banyumas',
            ],

            [
                'kode_ruangan' => 'P',
                'nama' => 'Kamar Penjaga Kwarcab',
                'lokasi' => 'Kwarcab Banyumas',
            ],
        ];
        Ruangan::insert($ruangan);
    }
}
