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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id_peminjaman');
            $table->unsignedBigInteger('id_peminjam');
            $table->foreign('id_peminjam')->references('id')->on('users');
            $table->unsignedBigInteger('id_petugas')->nullable();
            $table->foreign('id_petugas')->references('id')->on('users');
            $table->datetime('tgl_pengajuan');
            $table->datetime('tgl_pengembalian')->nullable();
            $table->date('tgl_rencana_pinjam');
            $table->date('tgl_rencana_kembali');
            $table->string('kegunaan');
            $table->string('status_verifikasi')->default('Dikirim');
            $table->string('catatan_pengembalian')->nullable();
            $table->datetime('tgl_acc')->nullable();
            $table->datetime('tgl_ditolak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
