<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Kategori;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('kategori')->get();
        return view('produk.index', compact('products'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        Product::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
            'status' => 1
        ]);

        return redirect('/produk')->with('success', 'Produk berhasil ditambahkan');
    }

    public function toggle($id)
    {
        $product = Product::find($id);
        $product->status = !$product->status;
        $product->save();

        return redirect('/produk');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('/produk')->with('success', 'Produk berhasil dihapus');
    }

    public function edit($id)
{
    $product = Product::findOrFail($id);
    $kategoris = Kategori::all();

    return view('produk.edit', compact('product', 'kategoris'));
}

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $product->update([
        'nama' => $request->nama,
        'harga' => $request->harga,
        'stok' => $request->stok,
        'kategori_id' => $request->kategori_id,
    ]);

    return redirect('/produk')->with('success', 'Produk berhasil diupdate');
}
}
