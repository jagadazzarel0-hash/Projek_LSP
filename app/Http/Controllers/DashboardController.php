<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Transaksi;

class DashboardController extends Controller
{
 public function index()
{
    $jumlahAdmin = User::count();
    $jumlahProduk = Product::where('status', 1)->count();

    // 🆕 TOTAL SALDO
    $jumlahSaldo = Transaksi::sum('total');

    // 🆕 PRODUK TERJUAL
    $produkTerjual = 0;

    foreach(Transaksi::all() as $trx){
        // sementara anggap 1 transaksi = 1 penjualan
        $produkTerjual++;
    }

    return view('dashboard', compact(
        'jumlahAdmin',
        'jumlahProduk',
        'jumlahSaldo',
        'produkTerjual'
    ));
}
}
