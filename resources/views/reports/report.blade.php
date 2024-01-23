@extends('layouts.main')
@section('container')
    @include('partials.header')
    <div class="m-3 p-3 pb-0 rounded-2 shadow-sm" style="position: relative; top: -6rem; background-color: white">
        <div class="d-flex align-items-center gap-2" style="position: relative; top: -0.4rem"><i
                class="bi bi-file-earmark-richtext flex-item" style="color: #475569"></i>
            <h6 class="m-0 text-dark flex-item" style="position: relative;">
                {{ count($reports->items()) }} / {{ $reports->total() }}</h6>
        </div>
        @if ($reports->total() != 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Ket</th>
                        <th scope="col" class="text-center">Hari/Tanggal</th>
                        <th scope="col" class="text-center">Pukul</th>
                        <th scope="col" class="text-center">SKU</th>
                        <th scope="col" class="text-center">Produk</th>
                        <th scope="col" class="text-center">Produk Masuk</th>
                        <th scope="col" class="text-center">Produk Keluar</th>
                        <th scope="col" class="text-center">Total Produk Masuk</th>
                        <th scope="col" class="text-center">Total Produk Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td class="text-center">
                                <i
                                    class=" {{ $report->information === 'in' ? 'bi bi-arrow-down text-success' : 'bi bi-arrow-up text-danger' }}"></i>
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::createFromDate($report->year, $report->month)->translatedFormat('l, d F Y') }}
                            </td>
                            <td class="text-center">
                                {{ $report->updated_at->translatedFormat('H:i:s') }}
                            </td>
                            <td class="text-center">{{ $report->product_sku }}</td>
                            <td class="text-center">{{ $report->product_name }}</td>
                            <td class="text-center">
                                {{ $report->incoming_product }}</td>
                            <td class="text-center">
                                {{ $report->outgoing_product }}</td>
                            <td class="text-center">
                                {{ $report->incoming_product_total }}</td>
                            <td class="text-center">
                                {{ $report->outgoing_product_total }}</td>

                        </tr>
                    @endforeach
                    <tr style="border: white 1px solid;">
                        <td class="text-center" style=" padding-top: 2rem !important;"></td>
                        <td class="text-center" style=" padding-top: 2rem !important;"></td>
                        <td class="text-center" style=" padding-top: 2rem !important;"></td>
                        <td class="text-center" style=" padding-top: 2rem !important;"></td>
                        <td class="text-center" style=" padding-top: 2rem !important;"></td>
                        <td class="text-center" style=" padding-top: 2rem !important;"></td>
                        <td class="text-center" style=" padding-top: 2rem !important;"><b>Total</b></td>
                        <td class="text-center" style=" padding-top: 2rem !important;">
                            <b>{{ $total[0]['total_incoming'] }}</b>
                        </td>
                        <td class="text-center" style=" padding-top: 2rem !important;">
                            <b>{{ $total[0]['total_outgoing'] }}</b>
                        </td>
                    </tr>
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
