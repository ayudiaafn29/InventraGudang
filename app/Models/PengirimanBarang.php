<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanBarang extends Model
{
    use HasFactory;

    protected $table = 'pengiriman_barang';

    protected $fillable = [
        'pengemasan_id',
        'nama_penerima',
        'status_pengiriman',
        'tanggal_dikirim',
    ];

    public function pengemasan()
    {
        return $this->belongsTo(PengemasanBarang::class, 'pengemasan_id');
    }
}
