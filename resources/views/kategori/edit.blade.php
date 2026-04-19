@extends('layouts.app')
@section('title', 'Edit Kategori')

@section('content')

<h4>Edit Kategori</h4>

<form method="POST" action="/kategori/{{ $kategori->id }}/update">
    @csrf

    <div class="mb-2">
        <label>Nama Kategori</label>
        <input type="text" name="nama" value="{{ $kategori->nama }}" class="form-control">
    </div>

    <div class="mb-2">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control">{{ $kategori->deskripsi }}</textarea>
    </div>

    <button class="btn btn-primary">Update</button>
</form>

@endsection
