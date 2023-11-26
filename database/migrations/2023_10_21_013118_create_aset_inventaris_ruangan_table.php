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
        Schema::create('aset_inventaris_ruangan', function (Blueprint $table) {
            $table->id('id_aset_inventaris_ruangan');
            $table->unsignedBigInteger('id_status_aset');
            $table->foreign('id_status_aset')->references('id_status_aset')->on('status_aset');
            $table->string('kode_ruangan');
            $table->foreign('kode_ruangan')->references('kode_ruangan')->on('ruangan');
            $table->string('grup_id')->nullable();
            $table->string('kode_aset')->unique();
            $table->string('nama');
            $table->date('tanggal_inventarisir')->default(now());
            $table->string('merk');
            $table->string('volume');
            $table->string('bahan');
            $table->integer('tahun');
            $table->integer('harga');
            $table->string('keterangan');
            $table->integer('jumlah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset_inventaris_ruangan');
    }
};
