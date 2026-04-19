@extends('layouts.app')
@section('title', 'Tambah Kategori')

@section('content')

<h4>Tambah Kategori</h4>

<form method="POST" action="/kategori/store">
    @csrf

    <div class="mb-2">
        <label>Nama Kategori</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control"></textarea>
    </div>

    <button class="btn btn-success">Simpan</button>
</form>

@endsection
