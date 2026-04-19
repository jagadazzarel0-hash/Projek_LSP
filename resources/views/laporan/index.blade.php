@extends('layouts.app')
@section('title', 'Laporan')
@section('content')

<h4>Laporan Penjualan</h4>

<!-- 🔍 FILTER TANGGAL -->
<form method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <label>Dari</label>
            <input type="date" name="dari" class="form-control" value="{{ request('dari') }}">
        </div>

        <div class="col-md-4">
            <label>Sampai</label>
            <input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}">
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </div>
</form>

<!-- 📊 TABLE -->
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Total</th>
    </tr>

    @foreach($transaksis as $t)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $t->created_at->format('d-m-Y H:i') }}</td>
        <td>Rp {{ number_format($t->total) }}</td>
    </tr>
    @endforeach
</table>

<!-- 💰 TOTAL -->
<h5>Total Pendapatan: Rp {{ number_format($total) }}</h5>

@endsection
