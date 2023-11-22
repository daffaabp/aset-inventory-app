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
        Schema::create('riwayat_peminjaman_inventaris_ruangan', function (Blueprint $table) {
            $table->id('id_riwayat_peminjaman_inventaris_ruangan');
            $table->unsignedBigInteger('id_peminjaman');
            $table->unsignedBigInteger('id_aset_inventaris_ruangan');
            $table->unsignedBigInteger('id_status_aset');
            $table->string('kode_aset');
            $table->string('kode_ruangan');
            $table->string('grup_id')->nullable();
            $table->string('nama');
            $table->string('merk');
            $table->string('volume');
            $table->string('bahan');
            $table->string('tahun');
            $table->string('harga');
            $table->string('keterangan');
            $table->integer('jumlah')->nullable();

            $table->date('tgl_perubahan_status');
            $table->string('status_verifikasi')->nullable();
            $table->string('kegunaan');
            $table->timestamps();

            $table->foreign('id_aset_inventaris_ruangan', 'fk_riwayat_aset_ruangan')->references('id_aset_inventaris_ruangan')->on('aset_inventaris_ruangan');
            $table->foreign('kode_ruangan')->references('kode_ruangan')->on('ruangan');
            $table->foreign('id_status_aset')->references('id_status_aset')->on('status_aset');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_peminjaman_inventaris_ruangan');
    }
};
