@extends('layouts.app')
@section('title', 'Produk')
@section('content')

<a href="/produk/create" class="btn btn-success mb-3">+ Tambah Produk</a>

<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Stok</th>
        <th>Aksi</th> <!-- tambahan -->
    </tr>

    @foreach($products as $p)
    <tr>
        <td>{{ $p->nama }}</td>
       <td>{{ $p->kategori->nama ?? '-' }}</td>
        <td>Rp {{ $p->harga }}</td>

        <!-- STATUS -->
        <td>
            @if($p->status)
                <span class="badge bg-success">Aktif</span>
            @else
                <span class="badge bg-danger">Nonaktif</span>
            @endif
        </td>

        <!-- STOK -->
        <td>{{ $p->stok }}</td>

        <!-- TOMBOL -->
        <td>
    <a href="/produk/{{ $p->id }}/edit" class="btn btn-primary btn-sm">
        Edit
    </a>

    <a href="/produk/{{ $p->id }}/toggle" class="btn btn-warning btn-sm">
        Toggle
    </a>

    <form action="/produk/{{ $p->id }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Yakin hapus produk ini?')" class="btn btn-dark btn-sm">
            Hapus
        </button>
    </form>
</td>

    </tr>
    @endforeach

</table>

@endsection
