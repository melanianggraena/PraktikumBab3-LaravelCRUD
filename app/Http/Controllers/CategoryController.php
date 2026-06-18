<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * ==============================
     * CHALLENGE #3
     * Resource Controller - index()
     * ==============================
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('categories.index', compact('categories'));
    }

    /**
     * ==============================
     * CHALLENGE #3
     * Resource Controller - create()
     * ==============================
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * ==============================
     * CHALLENGE #3
     * Resource Controller - store()
     *
     * CHALLENGE #4
     * Validasi unik name dan slug
     * ==============================
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            // CHALLENGE #4
            'name' => 'required|unique:categories,name',

            // CHALLENGE #4
            'slug' => 'required|unique:categories,slug',

            'description' => 'nullable',
            'is_active' => 'boolean',
        ]);

        Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * ==============================
     * CHALLENGE #3
     * Resource Controller - show()
     * ==============================
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * ==============================
     * CHALLENGE #3
     * Resource Controller - edit()
     * ==============================
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * ==============================
     * CHALLENGE #3
     * Resource Controller - update()
     *
     * CHALLENGE #4
     * Validasi unik name dan slug
     * ==============================
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([

            // CHALLENGE #4
            'name' => 'required|unique:categories,name,' . $category->id,

            // CHALLENGE #4
            'slug' => 'required|unique:categories,slug,' . $category->id,

            'description' => 'nullable',
            'is_active' => 'boolean',
        ]);

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * =====================================
     * CHALLENGE #8
     * Constraint:
     * Kategori tidak dapat dihapus
     * jika masih memiliki produk aktif
     * =====================================
     */
    public function destroy(Category $category)
    {

        $hasActiveProducts = $category
            ->products()
            ->where('status', 'active')
            ->exists();

        if ($hasActiveProducts) {

            return redirect()
                ->route('categories.index')
                ->with(
                    'error',
                    'Kategori tidak dapat dihapus karena masih memiliki produk aktif.'
                );
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Kategori berhasil dihapus.'
            );
    }
}
