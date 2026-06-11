<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaanBarang extends Model
{
    use HasFactory;

    protected $table = 'penerimaan_barang';

    protected $fillable = [
    'barang_id',
    'supplier_id',
    'petugas_id',
    'jumlah_diterima',
    'tanggal_masuk',
    'tanggal_kadaluarsa',
    'status_verifikasi',
];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
    public function penyimpanan()
{
    return $this->hasMany(PenyimpananBarang::class, 'penerimaan_id');
}

}