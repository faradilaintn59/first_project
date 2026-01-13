<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        if (!$cart) return redirect()->route('home');
        return view('user.checkout', compact('cart'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'metode' => 'required',
        ]);

        // Simulasikan pesanan berhasil
        Session::forget('cart');
        return redirect()->route('home')->with('success', 'Pesanan Anda berhasil diproses! Terima kasih.');
    }
}