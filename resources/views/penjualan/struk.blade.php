<!DOCTYPE html>
<html>
<head>
    <title>Struk</title>
    <style>
        body {
            font-family: monospace;
            width: 300px;
            margin: auto;
        }
        .center {
            text-align: center;
        }
        hr {
            border-top: 1px dashed black;
        }
    </style>
</head>
<body onload="window.print()">

<div class="center">
    <h3>INDOMARET</h3> <!-- 🏪 NAMA TOKO -->
    <p>Jl. Smea No.45</p> <!-- 📍 ALAMAT -->
    <p>{{ \Carbon\Carbon::parse(session('struk.tanggal'))->format('d-m-Y H:i') }}</p>
</div>

<hr>

<p>👤 Pembeli: {{ session('struk.pembeli') }}</p>

<hr>

@php $total = 0; @endphp

@foreach(session('struk.items') as $item)
    @php
        $qty = $item['qty'] ?? 1;
        $subtotal = $item['harga'] * $qty;
        $total += $subtotal;
    @endphp

    <div>
        {{ $item['nama'] }}<br>
        {{ $qty }} x {{ number_format($item['harga']) }}
        <span style="float:right">
            {{ number_format($subtotal) }}
        </span>
    </div>

@endforeach

<hr>

<div>
    <b>Total</b>
    <span style="float:right">
        Rp {{ number_format($total) }}
    </span>
</div>

<hr>



<div class="center">
    <p>Terima kasih 🙏</p>
</div>

</body>
</html>
