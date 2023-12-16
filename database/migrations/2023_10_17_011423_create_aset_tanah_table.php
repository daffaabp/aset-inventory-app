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
        Schema::create('aset_tanah', function (Blueprint $table) {
            $table->id('id_aset_tanah');
            $table->unsignedBigInteger('id_status_aset');
            $table->foreign('id_status_aset')->references('id_status_aset')->on('status_aset');
            $table->string('kode_aset')->unique();
            $table->string('nama', 50);
            $table->date('tanggal_inventarisir')->default(now());
            $table->decimal('luas');
            $table->string('letak_tanah');
            $table->string('hak');
            $table->date('tanggal_sertifikat');
            $table->string('no_sertifikat')->nullable();
            $table->string('penggunaan');
            $table->integer('harga');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset_tanah');
    }
};