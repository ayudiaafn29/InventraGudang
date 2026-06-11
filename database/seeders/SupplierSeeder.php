<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::create([
            'nama_supplier' => 'PT. Maju Jaya',
            'alamat_supplier' => 'Jl. Merdeka No. 10'
        ]);

        Supplier::create([
            'nama_supplier' => 'CV. Sumber Rejeki',
            'alamat_supplier' => 'Jl. Sudirman No. 25'
        ]);
    }
}
