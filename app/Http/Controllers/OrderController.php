<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct; // PENTING: Modul pakai OrderProduct
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function history()
    {
        // Sesuai Modul 11 Halaman 10 Point D.3
        $orders = OrderProduct::latest()->get();
        
        // Perhatikan nama view-nya 'user.riwayat'
        return view('user.riwayat', compact('orders')); 
    }
}