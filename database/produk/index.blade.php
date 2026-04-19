@extends('layouts.app')

@section('content')

<a href="/produk/create" class="btn btn-success mb-3">+ Tambah Produk</a>

<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
    </tr>

    @foreach($products as $p)
    <tr>
        <td>{{ $p->nama }}</td>
        <td>Rp {{ $p->harga }}</td>
        <td>{{ $p->stok }}</td>
    </tr>
    @endforeach

</table>

@endsection
