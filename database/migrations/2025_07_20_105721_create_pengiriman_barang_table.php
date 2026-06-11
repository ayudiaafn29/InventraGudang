<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengiriman_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengemasan_id')->constrained('pengemasan_barang')->onDelete('cascade');
            $table->string('nama_penerima');
            $table->string('status_pengiriman')->default('pending');
            $table->date('tanggal_dikirim');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengiriman_barang');
    }
};
