<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama',
        'kategori_id', // ✅ ini yang benar
        'harga',
        'stok',
        'status'
    ];

    // relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
