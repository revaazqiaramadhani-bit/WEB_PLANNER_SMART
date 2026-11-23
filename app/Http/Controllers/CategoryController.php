<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // 1. Menampilkan daftar kategori
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // 2. Menampilkan form tambah kategori
    public function create()
    {
        return view('categories.create');
    }

    // 3. Menyimpan kategori baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect('/categories')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // 4. Menampilkan form edit kategori
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // 5. Memperbarui kategori di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect('/categories')->with('success', 'Kategori berhasil diperbarui!');
    }

    // 6. Menghapus kategori
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('/categories')->with('success', 'Kategori berhasil dihapus!');
    }
}