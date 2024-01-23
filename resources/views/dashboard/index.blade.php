@extends('layouts.main')

@section('container')
    @include('partials.header')
    <div class=" d-flex justify-content-evenly align-items-center m-3 shadow-sm rounded-2"
        style="height: 10rem; position: relative; top: -6rem; background-color: white">
        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-box-seam flex-item" style="font-size: 48px; color: blueviolet"></i>
            <div class="d-flex flex-column flex-item">
                <p class="m-0" style="color: #334155">Data Produk</p>
                <h4 style="color: #475569" class="m-0">{{ $totalProducts }}</h4>
            </div>
        </div>
        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-box-arrow-in-down flex-item" style="font-size: 48px; color: #d946ef"></i>
            <div class="d-flex flex-column flex-item">
                <p class="m-0" style="color: #334155">Data Produk Masuk</p>
                <h4 style="color: #475569" class="m-0">
                    {{ $totalIncoming }}
                    <span style="font-size: 0.8rem; font-weight: 500">/ Bulan</span>
                </h4>

            </div>
        </div>
        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-box-arrow-up flex-item" style="font-size: 48px; color: #38bdf8"></i>
            <div class="d-flex flex-column flex-item">
                <p class="m-0" style="color: #334155">Data Produk Keluar</p>
                <h4 style="color: #475569" class="m-0">
                    {{ $totalOutgoing }}
                    <span style="font-size: 0.8rem; font-weight: 500">/ Bulan</span>
                </h4>
            </div>
        </div>
    </div>

    <div class="d-flex p-3 gap-3" style="position: relative; top: -7rem">
        <div class="d-flex gap-3 shadow-sm p-3 rounded-2 flex-item" style="width: 100%; background-color: white">
            <div class="d-flex justify-content-center align-items-center flex-item rounded-2"
                style="background-color: #fbbf24; width: 50px; height: 50px">
                <i class="bi bi-collection" style="font-size: 30px; color:white"></i>
            </div>
            <div class="flex-item">
                <p class="m-0">Data Jenis Produk</p>
                <h4 class="m-0">{{ $totalCategories }}</h4>
            </div>
        </div>
        <div class="d-flex gap-3 shadow-sm p-3 rounded-2 flex-item" style="width: 100%; background-color: white">
            <div class="d-flex justify-content-center align-items-center flex-item rounded-2"
                style="background-color: #4ade80; width: 50px; height: 50px">
                <i class="bi bi-box2" style="font-size: 30px; color:white"></i>
            </div>
            <div class="flex-item">
                <p class="m-0">Data Satuan</p>
                <h4 class="m-0">{{ $totalUnits }}</h4>
            </div>
        </div>
        <div class="d-flex gap-3 shadow-sm p-3 rounded-2 flex-item" style="width: 100%; background-color: white">
            <div class="d-flex justify-content-center align-items-center flex-item rounded-2"
                style="background-color: #a78bfa; width: 50px; height: 50px">
                <i class="bi bi-person" style="font-size: 30px; color:white"></i>
            </div>
            <div class="flex-item">
                <p class="m-0">Pengguna</p>
                <h4 class="m-0">{{ $totalUsers }}</h4>
            </div>
        </div>
    </div>

    <div class="d-flex" style="width: 100%; position: relative; top: -8rem; ">
        <div class="m-3 shadow-sm rounded-2 p-3" style="background-color: white; width: 100%;">
            <div class="d-flex align-items-center gap-2" style=" padding-bottom: 0.5rem">
                <i class="bi bi-info-circle-fill flex-item text-danger"></i>
                <p class="m-0 flex-item text-danger">Stok telah mencapai batas minimum</p>
            </div>
            @if (count($products) != 0)
                <table class="table mt-2">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">SKU</th>
                            <th scope="col" class="text-center">Name</th>
                            <th scope="col" class="text-center">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td class="text-center" style="padding-top:1rem ">{{ $loop->iteration }}</td>
                                <td class="text-center" style="padding-top:1rem">{{ $product['SKU'] }}</td>
                                <td class="text-center" style="padding-top:1rem">{{ $product->name }}</td>
                                <td class="text-center text-danger" style="padding-top:1rem">{{ $product['stock'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="d-flex justify-content-center align-items-center" style="height: 100%; width: 100%">
                    <p class="text-center" style="color: rgb(214, 214, 214) !important">Belum ada produk yang mencapai batas
                    </p>
                </div>
            @endif
        </div>
        <div class="m-3 shadow-sm rounded-2 p-3" style="background-color: white;  width: 100%;">
            <div class="d-flex align-items-center gap-2" style=" padding-bottom: 0.5rem">
                <i class="bi bi-clock-history flex-item"></i>
                <p class="m-0 flex-item"><b>Riwayat</b></p>
            </div>
            @if (count($histories) != 0)
                @foreach ($histories as $history)
                    <table>
                        <tr>
                            <td style="vertical-align: top;">
                                <i class="bi bi-caret-right-fill" style="color: tomato; margin-right: 0.5rem"></i>
                            </td>
                            <td style="vertical-align: top;">
                                <p class="m-0">{{ explode(' ', $history->user->name)[0] }}
                                    {!! $history->action !!}</p>
                            </td>
                        </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td>
                        <a href="/histories" class="btn btn-link p-0 pt-2">Lihat semua
                            riwayat</a>
                    </td>
                </tr>
                </table>
            @else
                <div class="d-flex justify-content-center align-items-center" style="height: 100%; width: 100%">
                    <p class="text-center" style="color: rgb(214, 214, 214) !important">Belum ada Riwayat
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
