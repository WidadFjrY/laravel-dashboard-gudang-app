<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\History;
use App\Models\Report;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest();
        if (request('search')) {
            $products->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('SKU', 'like', '%' . request('search') . '%');
        }

        return view('products.index', [
            'title' => 'Produk',
            'name' => 'Widad',
            'icon' => 'bi-box-seam-fill',
            'products' => $products->paginate(8)->withQueryString()
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
            'name' => 'required|max:255',
            'SKU' => 'required|max:255|unique:products',
            'category_id' => 'required',
            'weight' => 'required',
            'stock' => 'required',
            'unit_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required',
            'description' => 'nullable'
        ]);


        $filePath = $request->file('image')->store('product-images');
        $data['url_picture'] = $filePath;
        // $data['unit_id'] = intval($data['unit_id']);

        $report = Report::where('product_sku', $data['SKU'])->first();
        unset($data['image']);
        $product = Product::create($data);
        $name = $data['name'];
        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->translatedFormat('H:i:s | l, d F');

        History::create([
            'user_id' => $userId,
            'action' => "<span class='text-success'><b>Menambahkan</b></span> produk <b>$name</b> pada <b>$formattedDateTime</b>"
        ]);

        if ($report) {
            $report->update([
                'incoming_product_total' => $report->incoming_product_total + $data['stock'],
                'incoming_product' => $data['stock'],
                'outgoing_product' => 0,
                'information' => 'in'
            ]);

            return redirect('/product-in')->with('success', "Produk $name berhasil ditambahkan");
        }

        Report::create([
            'product_sku' => $product->SKU,
            'product_name' => $product->name,
            'incoming_product_total' => $data['stock'],
            'incoming_product' => $data['stock'],
            'outgoing_product' => 0,
            'information' => 'in'

        ]);

        return redirect('/product-in')->with('success', "Produk $name berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Product $product, $userId)
    {

        $data = $request->validate([
            'name' => 'required|max:255',
            'weight' => 'required',
            'unit_id' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $previousImagePath = $product->url_picture;

        if (isset($data['image'])) {
            $filePath = $request->file('image')->store('product-images');
            $data['url_picture'] = $filePath;

            Storage::delete($previousImagePath);
        }

        $product->update($data);
        $name = $data['name'];
        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->translatedFormat('H:i:s | l, d F');

        History::create([
            'user_id' => $userId,
            'action' => "<span class='text-primary'><b>Mengupdate</b></span> produk <b>$name</b> pada <b>$formattedDateTime</b>"
        ]);

        return redirect('/products')->with('success', "Mengupdate produk $name");
    }

    public function updateInc(Request $request, Product $product, $userId)
    {
        $report = Report::where('product_sku', $product->SKU)->first();
        $data = $request->validate([
            'stock' => 'required|numeric'
        ]);

        $name = $product->name;
        $stock = $product->stock;

        $product->update([
            'stock' => $stock + $data['stock'],
        ]);

        if ($report) {
            $report->update([
                'incoming_product_total' => $report->incoming_product_total + $data['stock'],
                'incoming_product' => $data['stock'],
                'outgoing_product' => 0,
                'information' => 'in',
            ]);
        } else {
            Report::create([
                'product_sku' => $product->SKU,
                'product_name' => $product->name,
                'incoming_product_total' => $data['stock'],
                'incoming_product' => $data['stock'],
                'outgoing_product' => 0,
                'information' => 'in'
            ]);
        }

        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->translatedFormat('H:i:s | l, d F');
        $stockInput = $data['stock'];
        History::create([
            'user_id' => $userId,
            'action' => "<span class='text-success'><b>Menambahkan $stockInput stok</b></span> produk <b>$name</b> pada <b>$formattedDateTime</b>"
        ]);

        return redirect('/product-in')->with('success', "Menambahkan stock $name");
    }

    public function updateDec(Request $request, Product $product, $userId)
    {
        $report = Report::where('product_sku', $product->SKU)->first();
        $data = $request->validate([
            'stock' => 'required|numeric'
        ]);

        $name = $product->name;
        $stock = $product->stock;

        if ($stock < $data['stock']) {
            return redirect('/product-out')->with('error', "Mengurangi stock $name");
        }

        $product->update([
            'stock' => $stock - $data['stock']
        ]);

        if ($report) {
            $report->update([
                'outgoing_product_total' => $report->outgoing_product_total + $data['stock'],
                'outgoing_product' => $data['stock'],
                'incoming_product' => 0,

                'information' => 'out'
            ]);
        } else {
            Report::create([
                'product_sku' => $product->SKU,
                'product_name' => $product->name,
                'outgoing_product_total' => $data['stock'],
                'outgoing_product' => $data['stock'],
                'incoming_product' => 0,
                'information' => 'out'
            ]);
        }

        if ($product->stock == 0) {
            Product::destroy($product['id']);
        }

        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->translatedFormat('H:i:s | l, d F');
        $stockInput = $data['stock'];
        History::create([
            'user_id' => $userId,
            'action' => "<span class='text-danger'><b>Mengurangi $stockInput stok</b></span> produk <b>$name</b> pada <b>$formattedDateTime</b>"
        ]);

        return redirect('/product-out')->with('success', "Mengurangi stock $name");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $userId)
    {
        $report = Report::where('product_sku', $product->SKU)->first();

        if ($report) {
            $report->update([
                'outgoing_product_total' => $report->outgoing_product_total + $product['stock'],
                'outgoing_product' => $product['stock'],
                'incoming_product' => 0,
                'information' => 'out'
            ]);
        } else {
            Report::create([
                'product_sku' => $product->SKU,
                'product_name' => $product->name,
                'outgoing_product_total' => $product['stock'],
                'outgoing_product' => $product['stock'],
                'incoming_product' => 0,
                'information' => 'out'
            ]);
        }

        Product::destroy($product['id']);

        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->translatedFormat('H:i:s | l, d F');

        History::create([
            'user_id' => $userId,
            'action' => "<span class='text-danger'><b>Mengurangi $product->stock stok</b></span> produk <b>$product->name</b> pada <b>$formattedDateTime</b>"
        ]);

        return redirect('/product-out')->with('success', "Produk $product->name berhasil dihapus");
    }

    public function getProduct($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function createProduct()
    {
        return view('product.create', [
            'title' => 'Tambah Produk',
            'icon' => 'bi-box-seam-fill',
            'categories' => Category::all(),
            'units' => Unit::all(),
        ]);
    }

    public function updateView(Product $product)
    {
        return view('product.update', [
            'title' => "Product Update $product->name",
            'icon' => 'bi-box-seam-fill',
            'product' => $product,
            'categories' => Category::all(),
            'units' => Unit::all()
        ]);
    }

    public function incomingProduct()
    {
        $products = Product::latest();
        if (request('search')) {
            $products->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('SKU', 'like', '%' . request('search') . '%');
        }

        return view('product.in', [
            'title' => 'Produk Masuk',
            'icon' => 'bi-box-arrow-in-down-right',
            'option' => 'Tambah Stok',
            'products' => $products->paginate(8)->withQueryString()
        ]);
    }

    public function outgoingProduct()
    {
        $products = Product::latest();
        if (request('search')) {
            $products->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('SKU', 'like', '%' . request('search') . '%');
        }

        return view('product.out', [
            'title' => 'Produk Keluar',
            'icon' => 'bi-box-arrow-up-left',
            'head' => 'Konfirmasi Hapus Prodouk',
            'desc' => 'Apakah yakin ingin menghapus produk ',
            'option' => 'Kurangi Stok',
            'products' => $products->paginate(8)->withQueryString()
        ]);
    }
}
