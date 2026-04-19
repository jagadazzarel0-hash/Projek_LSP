<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        Kategori::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect('/kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);

        $kategori->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect('/kategori')->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        Kategori::find($id)->delete();
        return back()->with('success', 'Kategori berhasil dihapus');
    }
}
