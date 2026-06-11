<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
    'kode_barang',
    'supplier_id',
    'nama_barang',
    'jenis_barang',
];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function penerimaanBarang()
    {
        return $this->hasMany(PenerimaanBarang::class, 'barang_id');
    }
}
