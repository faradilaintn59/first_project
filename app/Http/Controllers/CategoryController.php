<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View; // Pastikan ini di-import

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori (READ) [cite: 1618-1624]
     */
    public function index(Request $request): View
    {
        // Logika search dari Modul 5 [cite: 1622-1623]
        $categories = Category::when($request->input('search'), function ($query, $search) {
            $query->where('nama', 'like', '%' . $search . '%');
        })->paginate(10); // Ambil 10 data per halaman [cite: 1623]

        return view('category.index', compact('categories'));
    }

    /**
     * Menampilkan form tambah kategori (CREATE) [cite: 1625-1628]
     */
    public function create(): View
    {
        return view('category.create');
    }

    /**
     * Menyimpan kategori baru ke database [cite: 1629-1639]
     */
    public function store(Request $request)
    {
        // VALIDASI SESUAI TUGAS 5 (bukan Modul 5) 
        $request->validate([
            'nama' => 'required|string|min:3', // Wajib, string, minimal 3 karakter 
        ]);

        Category::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('category.index')
            ->with('success', 'Kategori berhasil ditambahkan.'); 
    }

    /**
     * Menampilkan detail (tidak dipakai di modul ini)
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Menampilkan form edit kategori (UPDATE) [cite: 1640-1647]
     */
    public function edit(Category $category): View
    {
        return view('category.edit', compact('category')); 
    }

    /**
     * Update kategori di database [cite: 1648-1659]
     */
    public function update(Request $request, Category $category)
    {
        // VALIDASI SESUAI TUGAS 5 
        $request->validate([
            'nama' => 'required|string|min:3', // Wajib, string, minimal 3 karakter 
        ]);

        $category->update([
            'nama' => $request->nama,
        ]); 

        return redirect()->route('category.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori dari database (DELETE) [cite: 1660-1665]
     */
    public function destroy(Category $category)
    {
        $category->delete(); 
        return redirect()->route('category.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}