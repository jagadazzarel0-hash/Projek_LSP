@extends('layouts.app')
@section('title', 'Kategori')

@section('content')

<a href="/kategori/create" class="btn btn-success mb-3">+ Tambah Kategori</a>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
    </tr>

    @foreach($kategoris as $k)
    <tr>
        <td>{{ $k->nama }}</td>
        <td>{{ $k->deskripsi }}</td>
        <td>
            <a href="/kategori/{{ $k->id }}/edit" class="btn btn-warning btn-sm">Edit</a>

            <form action="/kategori/{{ $k->id }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Yakin hapus?')" class="btn btn-dark btn-sm">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
