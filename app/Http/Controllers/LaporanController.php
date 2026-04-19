<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::query();

        // 🔍 filter tanggal
        if ($request->dari && $request->sampai) {
            $query->whereBetween('created_at', [
                $request->dari . ' 00:00:00',
                $request->sampai . ' 23:59:59'
            ]);
        }

        $transaksis = $query->latest()->get();

        // total semua
        $total = $transaksis->sum('total');

        return view('laporan.index', compact('transaksis', 'total'));
    }
}
