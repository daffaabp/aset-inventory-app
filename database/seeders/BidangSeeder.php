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
                'id_bidang' => 1,
                'nama' => 'Bidang Binamuda',
                'deskripsi' => 'Perumus kebijakan umum kwarcab dalam rangka pembinaan dan pengembangan pendidikan kepramukaan bagi anggota muda.',
            ],

            [
                'id_bidang' => 2,
                'nama' => 'Bidang Binawasa',
                'deskripsi' => 'Perumus kebijakan umum kwarcab dalam rangka pengembangan dan pembinaan anggota dewasa.',
            ],

            [
                'id_bidang' => 3,
                'nama' => 'Bidang Orhum',
                'deskripsi' => 'Perumus kebijakan umum kwarcab dalam bidang pembinaan organisasi dan hukum.',
            ],

            [
                'id_bidang' => 4,
                'nama' => 'Bidang Humas',
                'deskripsi' => 'Perumus kebijakan umum kwarcab dalam bidang pengabdian masyarakat dan humas.',
            ],

            [
                'id_bidang' => 5,
                'nama' => 'Bidang Abdimas',
                'deskripsi' => 'Pembina informasi dan publikasi kepada masyarakat.',
            ],

            [
                'id_bidang' => 6,
                'nama' => 'Bidang Bina Satuan',
                'deskripsi' => 'Penyusun kegiatan anggota dewasa.',
            ],

            [
                'id_bidang' => 7,
                'nama' => 'Bidang Keuangan & Sarpras',
                'deskripsi' => 'Perumus kebijakan umum kwarcab tentang keuangan, usaha dana, sarana dan prasarana.',
            ],

            [
                'id_bidang' => 8,
                'nama' => 'Sekretaris Kwarcab',
                'deskripsi' => 'Membantu peminjaman aset untuk Badan Pengurus Harian Kwarcab Banyumas.',
            ],

            [
                'id_bidang' => 9,
                'nama' => 'Petugas',
                'deskripsi' => 'Mengelola seluruh data aset di Kwarcab Banyumas serta melayani peminjaman lingkup internal.',
            ],

            [
                'id_bidang' => 10,
                'nama' => 'Superadmin',
                'deskripsi' => 'Memegang seluruh akses kontrol untuk role dan user pada sistem',
            ],

        ];
        Bidang::insert($bidang);
    }
}