<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage; // PENTING: Jangan sampai lupa ini!

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk
     */
    public function index(Request $request): View
    {
        // Fitur Search + Pagination
        $products = Product::with('kategori')->when($request->input('search'), function ($query, $search) {
            $query->where('nama', 'like', '%' . $search . '%');
        })->paginate(10);
        
        return view('products.index', compact('products'));
    }

    /**
     * Menampilkan form tambah produk
     */
    public function create(): View
    {
        $categories = Category::all(); // Kita butuh ini untuk dropdown kategori
        return view('products.create', compact('categories'));
    }

    /**
     * Menyimpan produk baru
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Validasi Gambar
            'kategori_id' => 'required|exists:categories,id',
        ]);

        // 2. Upload Foto
        // Foto akan disimpan di folder: storage/app/public/foto
        $fotoPath = $request->file('foto')->store('foto', 'public');

        // 3. Simpan ke Database
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

        // Cek apakah user mengupload foto baru?
        if ($request->hasFile('foto')) {
            // Hapus foto lama biar gak nyampah
            if ($product->foto && Storage::disk('public')->exists($product->foto)) {
                Storage::disk('public')->delete($product->foto);
            }
            // Simpan foto baru
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
        // Hapus file foto fisik dari storage
        if ($product->foto && Storage::disk('public')->exists($product->foto)) {
            Storage::disk('public')->delete($product->foto);
        }
        
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}