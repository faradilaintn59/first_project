<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menampilkan isi keranjang 
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Menambah produk ke keranjang 
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "nama" => $product->nama,
                "quantity" => 1,
                "harga" => $product->harga,
                "foto" => $product->foto
            ];
        }
        
        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang!');
    }

    // Mengupdate jumlah di keranjang 
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Jumlah produk diperbarui!');
    }

    // Menghapus produk dari keranjang 
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Produk dihapus!');
    }
}