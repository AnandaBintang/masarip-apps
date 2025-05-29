<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $query = Category::query();

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('perihal', 'like', "%{$search}%")
                    ->orWhere('tujuan', 'like', "%{$search}%");
            });
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $categories = $query->get();

        $data = [
            'title' => 'Kategori',
            'categories' => $categories,
        ];

        return view('category.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kategori',
        ];

        return view('category.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'perihal' => 'nullable|string|max:255',
            'tujuan' => 'nullable|string|max:255',
        ]);

        Category::create($request->only(['nama', 'perihal', 'tujuan']));

        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $data = [
            'title' => 'Edit Kategori',
            'category' => $category,
        ];

        return view('category.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'perihal' => 'nullable|string|max:255',
            'tujuan' => 'nullable|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->only(['nama', 'perihal', 'tujuan']));

        return redirect()->route('category.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
