@extends('layouts.main')
@section('container')
    @include('partials.header')
    <div class="m-3 p-3 rounded-2 shadow-sm" style="position: relative; top: -6rem; background-color: white">

        <div class="d-flex align-items-center gap-2" style="position: relative; top: -0.4rem"><i
                class="bi bi-file-earmark-richtext flex-item" style="color: #475569"></i>
            <h6 class="m-0 text-dark flex-item" style="position: relative;">
                {{ count($reports->items()) }} / {{ $reports->total() }}</h6>
        </div>
        @if ($reports->total() != 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Bulan</th>
                        <th scope="col" class="text-center">Total Produk Masuk</th>
                        <th scope="col" class="text-center">Total Produk Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td class="text-center">
                                <a class="text-decoration-none"
                                    href="/report/{{ $report->year }}/{{ $report->month }}">{{ \Carbon\Carbon::createFromDate($report->year, $report->month)->translatedFormat('F Y') }}</a>
                            </td>
                            <td class="text-center">
                                {{ $report->total_incoming }}</td>
                            <td class="text-center">
                                {{ $report->total_outgoing }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $reports->links() }}
        @else
            <div class="d-flex align-items-center flex-column justify-content-center" style="height: 80vh">
                <i class="bi bi-file-earmark-text-fill" style="font-size: 10rem; color: #e2e8f0;"></i>
                <h1 class="text-center" style="color: #e2e8f0;">Tidak ada laporan</h1>
            </div>
        @endif
    </div>
@endsection
