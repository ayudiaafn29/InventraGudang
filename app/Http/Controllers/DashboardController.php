<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenyimpananBarang;
use App\Models\PermintaanBarang;
use App\Models\PengirimanBarang;

class DashboardController extends Controller
{
    public function index()
    {
        // Jumlah penyimpanan (total stok)
        $jumlahPenyimpanan = PenyimpananBarang::sum('jumlah_stok');

        // Permintaan Hari Ini
        $permintaanHariIni = PermintaanBarang::whereDate('created_at', today())->count();

        // Pengiriman Hari Ini
        $pengirimanHariIni = PengirimanBarang::whereDate('created_at', today())->count();

        // Jumlah sedang dikirim
        $sedangDikirim = PengirimanBarang::where('status_pengiriman', 'sedang dikirim')->count();

        // Kapasitas penyimpanan
         $totalKapasitas = 10000 + 8000 + 5000;
        $terpakai = $jumlahPenyimpanan;

        $persentaseTerpakai = $totalKapasitas > 0 
            ? ($terpakai / $totalKapasitas) * 100 
            : 0;

        $sisaKapasitas = 100 - $persentaseTerpakai;
// Total stok kemarin
$penyimpananKemarin = PenyimpananBarang::whereDate('created_at', today()->subDay())->sum('jumlah_stok');

// Hitung persentase kenaikan
$kenaikanPenyimpanan = 0;
if ($penyimpananKemarin > 0) {
    $kenaikanPenyimpanan = (($jumlahPenyimpanan - $penyimpananKemarin) / $penyimpananKemarin) * 100;
}

        // Kirim data ke tampilan dashboard
        return view('dashboard', compact(
            'jumlahPenyimpanan',
            'permintaanHariIni',
            'pengirimanHariIni',
            'sedangDikirim',
            'persentaseTerpakai',
            'sisaKapasitas',
            'kenaikanPenyimpanan'

        ));
    }
}
