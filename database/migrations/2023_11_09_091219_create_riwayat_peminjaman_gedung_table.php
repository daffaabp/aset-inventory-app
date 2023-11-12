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
        Schema::create('riwayat_peminjaman_gedung', function (Blueprint $table) {
            $table->id('id_riwayat_peminjaman_gedung');
            $table->unsignedBigInteger('id_peminjaman');
            $table->unsignedBigInteger('id_aset_gedung');
            $table->unsignedBigInteger('id_status_aset');
            $table->string('kode_aset');
            $table->string('nama');
            $table->string('kondisi');
            $table->string('bertingkat');
            $table->string('beton');
            $table->decimal('luas_lantai');
            $table->string('lokasi');
            $table->year('tahun_dok');
            $table->string('nomor_dok');
            $table->decimal('luas');
            $table->enum('hak', ['HGB', 'Milik']);
            $table->string('harga');
            $table->string('keterangan');

            $table->date('tgl_perubahan_status');
            $table->string('status_verifikasi')->nullable();
            $table->string('kegunaan');
            $table->timestamps();

            $table->foreign('id_aset_gedung')->references('id_aset_gedung')->on('aset_gedung');
            $table->foreign('id_status_aset')->references('id_status_aset')->on('status_aset');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_peminjaman_gedung');
    }
};
