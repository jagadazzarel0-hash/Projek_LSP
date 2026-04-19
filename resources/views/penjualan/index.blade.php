@extends('layouts.app')
@section('title', 'Penjualan')
@section('content')

{{-- ✅ TOAST NOTIF --}}
@if(session('success'))
<div id="toastSuccess" style="
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    min-width: 250px;
">
    <div class="alert alert-success shadow">
        🎉 {{ session('success') }}
    </div>
    @if(session('error'))
    <div class="alert alert-danger">
        ❌ {{ session('error') }}
    </div>
@endif
</div>
@endif

<div class="row">

    <!-- KIRI -->
    <div class="col-md-8">

        <!-- SEARCH -->
        <form method="GET" action="/penjualan" class="mb-3">
            <div class="row">

                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}">
                </div>

                <div class="col-md-4">
                   <select name="kategori" class="form-control">
    <option value="">-- Semua Kategori --</option>
    @foreach($kategoris as $k)
        <option value="{{ $k->id }}"
            {{ request('kategori') == $k->id ? 'selected' : '' }}>
            {{ $k->nama }}
        </option>
    @endforeach
</select>
                </div>

                <div class="col-md-4">
                    <button class="btn btn-primary w-100">Filter</button>
                </div>

            </div>
        </form>

        <!-- PRODUK -->
        <div class="row">
            @forelse($products as $p)
            <div class="col-md-3 mb-3">
                <div class="card p-2 text-center shadow-sm">
                    <h6>{{ $p->nama }}</h6>
                    <p class="text-success">Rp {{ number_format($p->harga) }}</p>

                    <form method="POST" action="/penjualan/tambah">
                        @csrf
                        <input type="hidden" name="id" value="{{ $p->id }}">
                        <button class="btn btn-primary btn-sm w-100">
                            <i class="fas fa-cart-plus"></i> Tambah
                        </button>
                    </form>
                </div>
            </div>
            @empty
                <p class="text-center">Produk tidak ditemukan</p>
            @endforelse
        </div>

    </div>

    <!-- KANAN -->
    <div class="col-md-4">
        <div class="card p-3 shadow-sm">

            <h5>Keranjang</h5>

            @php $total = 0; @endphp

            @if(session('cart'))
                @foreach(session('cart') as $id => $item)

                @php
                    $qty = $item['qty'] ?? 1;
                    $total += $item['harga'] * $qty;
                @endphp

                <div class="d-flex justify-content-between align-items-center mb-2">

                    <div>
                        <b>{{ $item['nama'] }}</b><br>
                        Rp {{ number_format($item['harga']) }}
                    </div>

                    <div class="d-flex align-items-center">
                        <button onclick="kurang({{ $id }})" class="btn btn-danger btn-sm">-</button>
                        <span class="mx-2">{{ $qty }}</span>
                        <button onclick="tambah({{ $id }})" class="btn btn-success btn-sm">+</button>
                        <button onclick="hapus({{ $id }})" class="btn btn-dark btn-sm ms-1">🗑️</button>
                    </div>

                </div>

                @endforeach
            @else
                <p>Keranjang kosong</p>
            @endif

            <hr>

            <h5>Total: Rp <span id="total">{{ $total }}</span></h5>

            <!-- BAYAR -->
            <div class="mb-2">
                <label>Uang Bayar</label>
                <input type="number" id="bayar" class="form-control" placeholder="Masukkan uang">
            </div>

            <div class="mb-2">
                <label>Kembalian</label>
                <input type="text" id="kembalian" class="form-control" readonly>
                <div id="pesan" class="mt-2"></div>
            </div>

            <!-- FORM -->
            <form method="POST" action="/penjualan/bayar">
                @csrf

                <div class="mb-2">
                    <label>Metode Pembayaran</label>
                    <select name="metode" class="form-control">
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                        <option value="qris">QRIS</option>
                    </select>
                </div>

                <button id="btnBayar" class="btn btn-success w-100">
                    <i class="fas fa-money-bill"></i> Bayar
                </button>
                <a href="/penjualan/reset"
   onclick="return confirm('Yakin batalkan transaksi?')"
   class="btn btn-danger w-100 mt-2">
   ❌ Batal Transaksi
</a>
            </form>

        </div>
    </div>

</div>

<!-- AJAX -->
<script>
function tambah(id){
    fetch('/penjualan/plus/' + id, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
    }).then(() => location.reload());
}

function kurang(id){
    fetch('/penjualan/minus/' + id, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
    }).then(() => location.reload());
}

function hapus(id){
    fetch('/penjualan/hapus/' + id, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
    }).then(() => location.reload());
}
</script>

<!-- LOGIC -->
<script>
let total = {{ $total }};
const bayarInput = document.getElementById('bayar');
const kembalianInput = document.getElementById('kembalian');
const pesan = document.getElementById('pesan');
const btnBayar = document.getElementById('btnBayar');

bayarInput.addEventListener('input', function() {
    let bayar = parseInt(this.value) || 0;
    let kembali = bayar - total;

    if (kembali < 0) {
        kembalianInput.value = "- Rp " + Math.abs(kembali).toLocaleString("id-ID");
        pesan.innerHTML = '<div class="text-danger">❌ Maaf uang anda kurang</div>';
        btnBayar.disabled = true;
    } else {
        kembalianInput.value = "Rp " + kembali.toLocaleString("id-ID");
        pesan.innerHTML = '<div class="text-success">✅ Uang cukup, silakan bayar</div>';
        btnBayar.disabled = false;
    }
});
</script>

<!-- TOAST AUTO HILANG LANGSUNG -->
<script>
let toast = document.getElementById('toastSuccess');

if(toast){
    toast.style.transition = "all 0.5s";
    toast.style.opacity = "1";

    setTimeout(() => {
        toast.style.opacity = "0";
        toast.style.transform = "translateX(50px)";
    }, 300); // langsung hilang

    setTimeout(() => {
        toast.remove();
    }, 600);
}
</script>

@endsection
