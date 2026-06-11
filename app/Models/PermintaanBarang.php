<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanBarang extends Model
{
    use HasFactory;

    protected $table = 'permintaan_barang';

    protected $fillable = [
    'penyimpanan_id',
    'nama_barang_diminta',
    'jumlah_barang_diminta',
    'status_permintaan',
    'tujuan_pengiriman',
    'tanggal_kadaluarsa',
];


    public function penyimpanan()
    {
        return $this->belongsTo(PenyimpananBarang::class, 'penyimpanan_id');
    }
}
