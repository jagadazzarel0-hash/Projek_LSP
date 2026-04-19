@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="bg-info p-3 text-white">
            <h4>{{ $jumlahAdmin }}</h4>
            <p>Jumlah Admin</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="bg-success p-3 text-white">
            <h4>{{ $jumlahProduk }}</h4>
            <p>Jumlah Produk</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="bg-primary p-3 text-white">
            <h4>Rp {{ number_format($jumlahSaldo) }}</h4>
            <p>Jumlah saldo</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="bg-danger p-3 text-white">
           <h4>{{ $produkTerjual }}</h4>
            <p>Produk Terjual</p>
        </div>
    </div>

</form>
</div>
@endsection
