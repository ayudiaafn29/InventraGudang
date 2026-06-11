<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyimpananBarang extends Model
{
    use HasFactory;

    protected $table = 'penyimpanan_barang';

    protected $fillable = [
        'penerimaan_id',
        'lokasi_penyimpanan',
        'kategori_barang',
        'kapasitas_rak',
        'jumlah_stok',
        'tanggal_kadaluarsa',
        'petugas_id',
        'status_barang',

    ];

    public function penerimaan()
    {
        return $this->belongsTo(PenerimaanBarang::class, 'penerimaan_id');
    }
    public function petugas()
{
    return $this->belongsTo(User::class, 'petugas_id');
}

}
