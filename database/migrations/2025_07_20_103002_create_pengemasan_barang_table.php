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
        Schema::create('pengemasan_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permintaan_id')
                  ->constrained('permintaan_barang')
                  ->onDelete('cascade');
            $table->integer('jumlah_barang_dikemas');
            $table->string('tujuan_pengiriman');
            $table->date('tanggal_pengemasan');
            $table->string('status_pengemasan')->default('proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengemasan_barang');
    }
};
