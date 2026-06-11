<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permintaan_barang', function (Blueprint $table) {
    $table->id();
    $table->foreignId('penyimpanan_id')->constrained('penyimpanan_barang')->onDelete('cascade');
    $table->string('nama_barang_diminta');
    $table->integer('jumlah_barang_diminta');
    $table->string('status_permintaan')->default('pending');
    $table->string('tujuan_pengiriman'); // Tambahkan ini
    $table->date('tanggal_kadaluarsa')->nullable();
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('permintaan_barang');
    }
};
