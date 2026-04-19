@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Tambah Produk</div>

    <div class="card-body">
        <form action="/produk/store" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Produk</label>
                <input type="text" name="nama" class="form-control">
            </div>

            <div class="mb-3">
    <label>Kategori</label>
    <select name="kategori_id" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategoris as $k)
            <option value="{{ $k->id }}">{{ $k->nama }}</option>
        @endforeach
    </select>
</div>

            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control">
            </div>

            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control">
            </div>

            <div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="1">Aktif</option>
        <option value="0">Nonaktif</option>
    </select>
</div>

            <button class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
