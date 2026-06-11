<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use Illuminate\Support\Str;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $barangs = [
            [
                'supplier_id'    => 1,
                'nama_barang'    => 'Beras Premium',
                'jenis_barang'   => 'Sembako',
            ],
            [
                'supplier_id'    => 1,
                'nama_barang'    => 'Minyak Goreng',
                'jenis_barang'   => 'Sembako',
            ],
            [
                'supplier_id'    => 2,
                'nama_barang'    => 'Gula Pasir',
                'jenis_barang'   => 'Sembako',
            ],
        ];

        foreach ($barangs as $index => $data) {
            $kode = 'BRG' . str_pad($index + 1, 4, '0', STR_PAD_LEFT);

            Barang::create([
                'supplier_id'    => $data['supplier_id'],
                'kode_barang'    => $kode,
                'nama_barang'    => $data['nama_barang'],
                'jenis_barang'   => $data['jenis_barang'],
            ]);
        }
    }
}
