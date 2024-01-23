<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Models\History;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::latest();
        if (request('search')) {
            $units->where('name', 'like', '%' . request('search') . '%');
        }

        return view('units.index', [
            'title' => 'Data Satuan',
            'icon' => 'bi-stack',
            'units' => $units->paginate(10)->withQueryString(),
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
            'new_unit' => 'required|max:255'
        ]);

        $data['name'] = $data['new_unit'];
        $data['slug'] = strtolower($data['name']);
        unset($data['new_unit']);

        Unit::create($data);
        $name = $data['name'];

        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->translatedFormat('H:i:s | l, d F');

        History::create([
            'user_id' => $userId,
            'action' => "<span class='text-success'><b>Menambahkan</b></span> satuan <b>$name</b> pada <b>$formattedDateTime</b>"
        ]);

        return redirect('/units')->with('success', "Menambahkan Satuan $name");
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit, $userId)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        $unit->update($data);
        $name = $data['name'];

        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->translatedFormat('H:i:s | l, d F');

        History::create([
            'user_id' => $userId,
            'action' => "<span class='text-primary'><b>Mengupdate</b></span> satuan <b>$name</b> pada <b>$formattedDateTime</b>"
        ]);
        return redirect('/units')->with('success', "Mengubah Satuan $name");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit, $userId)
    {
        $name = $unit['name'];
        Unit::destroy($unit['id']);

        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->translatedFormat('H:i:s | l, d F');

        History::create([
            'user_id' => $userId,
            'action' => "<span class='text-danger'><b>Menghapus</b></span> satuan <b>$name</b> pada <b>$formattedDateTime</b>"
        ]);

        return redirect('/units')->with('success', "Menghapus Satuan $name");
    }

    public function checkUnit($id)
    {
        $unit = Unit::find($id);
        $productCount = $unit->products()->count();
        if ($productCount > 0) {
            return response()->json(['error' => 'Gagal karena unit memiliki product'], 400);
        }
        return response()->json($unit);
    }

    public function getUnit($id)
    {
        $unit = Unit::find($id);
        return response()->json($unit);
    }

    public function showUnitWithProduct(Unit $unit)
    {
        $products = $unit->products();
        if (request('search')) {
            $products->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('SKU', 'like', '%' . request('search') . '%');
        }

        return view('units.unit', [
            'title' => "Produk Satuan $unit->name",
            'icon' => 'bi-stack',
            'slug' => $unit->slug,
            'products' => $products->paginate(8)->withQueryString(),
        ]);
    }
}
