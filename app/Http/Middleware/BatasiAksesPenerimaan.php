<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BatasiAksesPenerimaan
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Jika email petugas penerimaan
        if ($user && $user->email === 'penerimaan@email.com') {
            // Hanya izinkan akses ke dashboard dan penerimaan
            $routeName = $request->route()->getName();
            
            if (in_array($routeName, ['dashboard', 'penerimaan_barang.index', 'penerimaan_barang.edit', 'penerimaan_barang.update', 'penerimaan_barang.store', 'penerimaan_barang.create', 'penerimaan_barang.destroy'])) {
                return $next($request);
            } else {
                abort(403, 'Akses ditolak.');
            }
        }

        return $next($request);
    }
}
