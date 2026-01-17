<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Karena ID kita pakai format string
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'user_id', 'tanggal', 'total', 'alamat', 'telepon', 'metode', 'status_pembayaran', 'bukti_pembayaran'
    ];

    // Relasi: Order ini milik siapa? 
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relasi: Order ini isinya produk apa saja?
    public function products() {
        return $this->belongsToMany(Product::class, 'order_products')
                    ->withPivot('jumlah', 'harga_satuan')
                    ->withTimestamps();
    }
}