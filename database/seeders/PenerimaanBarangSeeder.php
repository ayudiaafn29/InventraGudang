<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PenerimaanBarang;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\User;

class PenerimaanBarangSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada data barang, supplier, dan user
        $barang   = Barang::first();
        $supplier = Supplier::first();
        $user     = User::first(); // Petugas

        if (!$barang || !$supplier || !$user) {
            $this->command->warn('Data barang/supplier/user belum ada, jalankan seeder SupplierSeeder & BarangSeeder dulu!');
            return;
        }

        PenerimaanBarang::create([
            'barang_id'        => $barang->id,
            'supplier_id'      => $supplier->id,
            'petugas_id'       => $user->id,
            'jumlah_diterima'  => 50,
            'tanggal_masuk'    => now()->format('Y-m-d'),
            'status_verifikasi'=> 'pending',
        ]);

        PenerimaanBarang::create([
            'barang_id'        => $barang->id,
            'supplier_id'      => $supplier->id,
            'petugas_id'       => $user->id,
            'jumlah_diterima'  => 100,
            'tanggal_masuk'    => now()->subDays(2)->format('Y-m-d'),
            'status_verifikasi'=> 'verified',
        ]);
    }
}
