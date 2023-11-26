<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bidang = [
            [
                'nama' => 'Bidang Binamuda',
                'deskripsi' => 'Perumus kebijakan umum kwarcab dalam rangka pembinaan dan pengembangan
                pendidikan kepramukaan bagi anggota muda.',
            ],

            [
                'kode_ruangan' => 'Bidang Binawasa',
                'deskripsi' => 'Perumus kebijakan umum kwarcab dalam rangka pengembangan dan pembinaan
                anggota dewasa.',
            ],

            [
                'kode_ruangan' => 'Bidang Orhum',
                'deskripsi' => 'Perumus kebijakan umum kwarcab dalam bidang pembinaan organisasi dan
                hukum.',
            ],

            [
                'kode_ruangan' => 'Bidang Humas',
                'deskripsi' => 'Perumus kebijakan umum kwarcab dalam bidang pengabdian masyarakat dan
                humas.',
            ],

            [
                'kode_ruangan' => 'Bidang Abdimas',
                'deskripsi' => 'Pembina informasi dan publikasi kepada masyarakat.',
            ],

            [
                'kode_ruangan' => 'Bidang Bina Satuan',
                'deskripsi' => 'Penyusun kegiatan anggota dewasa.',
            ],

            [
                'kode_ruangan' => 'Bidang Keuangan & Sarpras',
                'deskripsi' => 'Perumus kebijakan umum kwarcab tentang keuangan, usaha dana, sarana dan
                prasarana.',
            ],
        ];
        Bidang::insert($bidang);
    }
}
