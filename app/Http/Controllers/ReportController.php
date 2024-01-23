<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(incoming_product_total) as total_incoming'),
            DB::raw('SUM(outgoing_product_total) as total_outgoing'),
        )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(8);

        return view('reports.index', [
            'title' => 'Laporan Bulanan',
            'icon' => 'bi-file-earmark-text-fill',
            'reports' => $reports->withQueryString(),
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
    public function store(StoreReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($year, $month)
    {
        $reports = Report::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->paginate(8);

        $monthName = Carbon::createFromDate($year, $month)->translatedFormat('F');

        $total = Report::select(
            DB::raw('SUM(incoming_product_total) as total_incoming'),
            DB::raw('SUM(outgoing_product_total) as total_outgoing'),
        )
            ->get();

        $reports->withQueryString();

        return view('reports.report', [
            'title' => "Laporan Bulanan : $monthName $year",
            'icon' => 'bi-file-earmark-text-fill',
            'reports' => $reports,
            'total' => $total
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
