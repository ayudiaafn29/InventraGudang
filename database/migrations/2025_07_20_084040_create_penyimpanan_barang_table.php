<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyimpanan_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penerimaan_id')->constrained('penerimaan_barang')->onDelete('cascade');
            $table->foreignId('petugas_id')->constrained('users');
            $table->string('lokasi_penyimpanan');
            $table->string('kategori_barang');
            $table->integer('kapasitas_rak');
            $table->integer('jumlah_stok');
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->string('status_barang')->default('Belum Tersimpan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyimpanan_barang');
    }
};
