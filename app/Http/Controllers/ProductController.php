<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage; 

class ProductController extends Controller
{
    public function create(): View
    {
        $categories = Category::all(); 
        
        // Cek apakah folder views/products/create.blade.php benar-benar ada
        return view('products.create', compact('categories'));
    }
    
    public function index(Request $request): View
    {
        // Gunakan 'kategori' sesuai dengan nama method relasi di Model Product kamu
        $products = Product::with('kategori')->when($request->input('search'), function ($query, $search) {
            $query->where('nama', 'like', '%' . $search . '%');
        })->paginate(10);
        
        return view('products.index', compact('products'));
    }

    /**
     * Menampilkan form tambah produk
     */
    

    /**
     * Menyimpan produk baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'kategori_id' => 'required|exists:categories,id',
        ]);

        $fotoPath = $request->file('foto')->store('foto', 'public');

        Product::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit produk
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update produk
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'kategori_id' => 'required|exists:categories,id',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            if ($product->foto && Storage::disk('public')->exists($product->foto)) {
                Storage::disk('public')->delete($product->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Menghapus produk
     */
    public function destroy(Product $product)
    {
        if ($product->foto && Storage::disk('public')->exists($product->foto)) {
            Storage::disk('public')->delete($product->foto);
        }
        
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}