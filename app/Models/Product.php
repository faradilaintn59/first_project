<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // DAFTAR KOLOM YANG BOLEH DIISI (PENTING!)
    protected $fillable = [
        "foto",
        "nama",
        "deskripsi",
        "harga",
        "stok",
        "kategori_id"
    ];

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }
}