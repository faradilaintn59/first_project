<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- TAMBAHKAN BARIS INI
use Illuminate\Database\Eloquent\Model; 

class Category extends Model
{
    use HasFactory; // <-- Baris ini sekarang jadi benar

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
    ];
}