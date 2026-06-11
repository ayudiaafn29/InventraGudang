<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengemasanBarang extends Model
{
    use HasFactory;

    protected $table = 'pengemasan_barang';

    protected $fillable = [
        'permintaan_id',
        'jumlah_barang_dikemas',
        'tujuan_pengiriman',
        'tanggal_pengemasan',
        'status_pengemasan'
    ];

    public function permintaan()
    {
        return $this->belongsTo(PermintaanBarang::class, 'permintaan_id');
    }
}
