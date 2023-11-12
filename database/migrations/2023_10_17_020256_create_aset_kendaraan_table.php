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
        Schema::create('aset_kendaraan', function (Blueprint $table) {
            $table->id('id_aset_kendaraan');
            $table->unsignedBigInteger('id_status_aset');
            $table->foreign('id_status_aset')->references('id_status_aset')->on('status_aset');
            $table->string('kode_aset')->unique();
            $table->string('nama');
            $table->string('merk');
            $table->string('type');
            $table->string('cylinder');
            $table->string('warna');
            $table->string('no_rangka');
            $table->string('no_mesin');
            $table->string('thn_pembuatan');
            $table->string('thn_pembelian');
            $table->string('no_polisi')->unique();
            $table->date('tgl_bpkb');
            $table->string('no_bpkb');
            $table->string('harga');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset_kendaraan');
    }
};