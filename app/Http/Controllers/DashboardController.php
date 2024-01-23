<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\History;
use App\Models\Product;
use App\Models\Report;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()

    {
        $products = Product::orderBy('stock', 'asc')->where('stock', '<=', 10)->take(4)->get();
        $histories = History::with('user')->orderBy('created_at', 'desc')->take(6)->get();

        $totalIncoming = Report::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->selectRaw('SUM(incoming_product_total) as total_incoming')
            ->first();

        $totaloutgoing = Report::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->selectRaw('SUM(outgoing_product_total) as total_outgoing')
            ->first();

        $formatedIncoming = $this->format((int)$totalIncoming['total_incoming']);
        $formatedOutgoing = $this->format((int)$totaloutgoing['total_outgoing']);
        $formatedProduct = $this->format((int)Product::count());

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'icon' => 'bi-house-door-fill',
            'products' => $products,
            'totalUsers' => User::count(),
            'totalProducts' => $formatedProduct,
            'totalCategories' => Category::count(),
            'totalUnits' => Unit::count(),
            'totalIncoming' => $formatedIncoming,
            'totalOutgoing' => $formatedOutgoing,
            'histories' => $histories
        ]);
    }
    private function format($value)
    {
        if ($value >= 1000) {
            return number_format($value / 1000, 2) . 'k';
        }

        return $value;
    }
}
