<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
        SupplierSeeder::class,
        BarangSeeder::class,
        PenerimaanBarangSeeder::class,
    ]);
        // === Buat semua role ===
        $roles = [
            'manager_gudang',
            'petugas_penerimaan',
            'petugas_penyimpanan',
            'petugas_pengemasan',
            'petugas_pengantar',
            'permintaan_barang'
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // === Buat user manager ===
        $manager = User::firstOrCreate(
            ['email' => 'manager@gudang.com'],
            [
                'name' => 'Manager Gudang',
                'password' => bcrypt('123456')
            ]
        );
        $manager->assignRole('manager_gudang');

        // === Buat user untuk semua role lain ===
        $users = [
            [
                'name' => 'Petugas Penerimaan',
                'email' => 'penerimaan@gudang.com',
                'role' => 'petugas_penerimaan'
            ],
            [
                'name' => 'Petugas Penyimpanan',
                'email' => 'penyimpanan@gudang.com',
                'role' => 'petugas_penyimpanan'
            ],
            [
                'name' => 'Petugas Pengemasan',
                'email' => 'pengemasan@gudang.com',
                'role' => 'petugas_pengemasan'
            ],
            [
                'name' => 'Petugas Pengantar',
                'email' => 'pengantar@gudang.com',
                'role' => 'petugas_pengantar'
            ],
            [
                'name' => 'Permintaan Barang',
                'email' => 'permintaan@gudang.com',
                'role' => 'permintaan_barang'
            ],
        ];

        foreach ($users as $u) {
            $user = User::firstOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'password' => bcrypt('123456')
                ]
            );
            $user->assignRole($u['role']);
        }
    }
}
