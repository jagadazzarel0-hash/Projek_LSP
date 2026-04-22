@extends('layouts.app')
@section('title', 'Edit Produk')

@section('content')

<h4>Edit Produk</h4>

<form action="/produk/{{ $product->id }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-2">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ $product->nama }}" required>
    </div>

    <div class="mb-2">
        <label>Kategori</label>
        <select name="kategori_id" class="form-control">
            @foreach($kategoris as $k)
                <option value="{{ $k->id }}"
                    {{ $product->kategori_id == $k->id ? 'selected' : '' }}>
                    {{ $k->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-2">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" value="{{ $product->harga }}">
    </div>

    <div class="mb-2">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ $product->stok }}">
    </div>

    <button class="btn btn-success">Update</button>
    <a href="/produk" class="btn btn-secondary">Kembali</a>
</form>

@endsection
