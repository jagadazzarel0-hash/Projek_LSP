<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Kategori;

class PenjualanController extends Controller
{
    public function index(Request $request)
{
    $query = Product::where('status', 1);

    // 🔍 SEARCH
    if ($request->search) {
        $query->where('nama', 'like', '%' . $request->search . '%');
    }

    // 🏷️ FILTER KATEGORI (PAKAI ID)
    if ($request->kategori) {
        $query->where('kategori_id', $request->kategori);
    }

    // ambil produk + relasi kategori
    $products = $query->with('kategori')->get();

    // ambil semua kategori
    $kategoris = Kategori::all();

    return view('penjualan.index', compact('products', 'kategoris'));
}

    public function tambah(Request $request)
    {
        $product = Product::find($request->id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += 1;
        } else {
            $cart[$product->id] = [
                'nama' => $product->nama,
                'harga' => $product->harga,
                'qty' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect('/penjualan');
    }

    public function tambahQty($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
        }

        session()->put('cart', $cart);
        return back();
    }

    public function kurangQty($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] -= 1;

            if ($cart[$id]['qty'] <= 0) {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);
        return back();
    }

    public function hapus($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);
        return back();
    }

    public function bayar(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = 0;

        if(empty($cart)){
            return back()->with('error', 'Keranjang kosong!');
        }

        foreach($cart as $id => $item){

            $product = Product::find($id);

            if($product){

                if($product->stok < $item['qty']){
                    return back()->with('error', 'Stok tidak cukup untuk ' . $product->nama);
                }

                $total += $item['harga'] * $item['qty'];

                $product->stok -= $item['qty'];
                $product->save();
            }
        }

        // ✅ SIMPAN TRANSAKSI
        Transaksi::create([
            'total' => $total
        ]);

        // 🔥 SIMPAN STRUK (INI YANG KAMU BELUM ADA)
        session()->put('struk', [
    'items' => $cart,
    'total' => $total,
    'tanggal' => now(),
    'pembeli' => auth()->user()->name // 🔥 dari login
]);

        // kosongkan cart
        session()->forget('cart');

        // 🔥 PINDAH KE HALAMAN STRUK
        return redirect('/struk');
    }
}
