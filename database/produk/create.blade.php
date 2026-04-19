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
                <label>Harga</label>
                <input type="number" name="harga" class="form-control">
            </div>

            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control">
            </div>

            <button class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
