<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayat_peminjaman_tanah', function (Blueprint $table) {
            $table->id('id_riwayat_peminjaman_tanah');
            $table->unsignedBigInteger('id_peminjaman');
            $table->unsignedBigInteger('id_aset_tanah');
            $table->unsignedBigInteger('id_status_aset');
            $table->string('kode_aset');
            $table->string('nama');
            $table->decimal('luas');
            $table->string('letak_tanah');
            $table->string('hak');
            $table->date('tanggal_sertifikat');
            $table->string('no_sertifikat');
            $table->string('penggunaan');
            $table->string('harga');
            $table->string('keterangan');

            // yang bersangkutan dengan peminjaman
            $table->date('tgl_perubahan_status');
            $table->string('status_verifikasi')->nullable();
            $table->string('kegunaan');
            $table->timestamps();

            // Definisikan indeks atau foreign keys yang diperlukan
            // $table->foreign('id_peminjaman')->references('id_peminjaman')->on('peminjaman');
            $table->foreign('id_aset_tanah')->references('id_aset_tanah')->on('aset_tanah');
            $table->foreign('id_status_aset')->references('id_status_aset')->on('status_aset');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_peminjaman_tanah');
    }
};
