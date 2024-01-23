<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\History;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest();
        if (request('search')) {
            $categories->where('name', 'like', '%' . request('search') . '%');
        }

        return view('categories.index', [
            'title' => 'Kategori Produk',
            'icon' => 'bi-tags-fill',
            'categories' => $categories->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $userId)
    {
        $data = $request->validate([
            'new_category' => 'required|max:255'
        ]);

        $data['name'] = $data['new_category'];
        $data['slug'] = strtolower($data['name']);
        unset($data['new_category']);

        $category = Category::create($data);

        $name = $data['name'];
        $created_at = $category['created_at'];
        $dateFormated = $created_at->translatedFormat('l, d F');

        $time = $category['created_at'];
        $timeFormated = $time->translatedFormat('H:i:s');

        History::create([
            'user_id' => $userId,
            'action' => "<span class='text-success'><b>Menambahkan</b></span> kategori <b>$name</b> pada <b>$timeFormated | $dateFormated</b>"
        ]);

        $name = $data['name'];

        return redirect('/categories')->with('success', "Menambahkan kategori $name");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category, $userId)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        $category->update($data);
        $name = $data['name'];
        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->translatedFormat('H:i:s | l, d F');

        History::create([
            'user_id' => $userId,
            'action' => "<span class='text-primary'><b>Mengupdate</b></span> kategori <b>$name</b> pada <b>$formattedDateTime</b>"
        ]);

        return redirect('/categories')->with('success', "Mengubah kategoro $name");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, $userId)
    {
        $name = $category['name'];
        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->translatedFormat('H:i:s | l, d F');

        History::create([
            'user_id' => $userId,
            'action' => "<span class='text-danger'><b>Menghapus</b></span> kategori <b>$name</b> pada <b>$formattedDateTime</b>"
        ]);

        Category::destroy($category['id']);

        return redirect('/categories')->with('success', "Menghapus kategory $name");
    }

    public function checkCategory($id)
    {
        $category = Category::find($id);
        $productCount = $category->products()->count();
        if ($productCount > 0) {
            return response()->json(['error' => 'Gagal karena category memiliki product'], 400);
        }
        return response()->json($category);
    }

    public function getCategory($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    public function showCategoryWithProduct(Category $category)
    {
        $products = $category->products();
        if (request('search')) {
            $products->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('SKU', 'like', '%' . request('search') . '%');
        }

        return view('categories.category', [
            'title' => "Produk Kategori $category->name",
            'icon' => 'bi-tags-fill',
            'slug' => $category->slug,
            'products' => $products->paginate(8)->withQueryString(),
        ]);
    }
}
