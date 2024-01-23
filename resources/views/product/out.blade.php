@extends('layouts.main')

@section('container')
    @include('partials.header')

    <div style="background-color: white; position: relative; top: -6rem" class="m-3 p-3 rounded-2 shadow-sm">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                style="position: absolute; z-index: 999; top: 0; left: 0; width: 100%">
                <strong>Gagal</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="position: absolute; z-index: 999; top: 0; left: 0; width: 100%">
                <strong>Berhasil</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="/product-in">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari berdasarkan SKU/Produk" name="search"
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit" id="search">Cari</button>
            </div>
        </form>
        <div class="d-flex align-items-center gap-2" style="position: relative; top: -0.4rem"><i
                class="bi bi-box-seam flex-item" style="color: #475569"></i>
            <h6 class="m-0 text-dark flex-item" style="position: relative;">
                {{ count($products->items()) }} / {{ $products->total() }}</h6>
        </div>

        @if ($products->total() != 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">SKU</th>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Kategori</th>
                        <th scope="col" class="text-center">Harga</th>
                        <th scope="col" class="text-center">Stok</th>
                        <th scope="col" class="text-center">Satuan</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="text-center" style="padding-top:1rem">{{ $loop->iteration }}</td>
                            <td class="text-center" style="padding-top:1rem">{{ $product['SKU'] }}</td>
                            <td class="text-center" style="padding-top:1rem">{{ $product['name'] }}</td>
                            <td class="text-center" style="padding-top:1rem">{{ $product->category->name }}</td>
                            <td class="text-center" style="padding-top: 1rem">
                                Rp.{{ number_format($product['price'], 0, ',', '.') }},00</td>
                            <td class="text-center" style="padding-top:1rem">{{ $product['stock'] }}</td>
                            <td class="text-center" style="padding-top:1rem">{{ $product->unit->name }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-secondary btn-modal-stock-del" data-toggle="modal"
                                    data-target="#modalStockDel" data-product-id="{{ $product['id'] }}"
                                    data-user-id="{{ auth()->user()->id }}">
                                    Kurangi Stok
                                </button>
                                <button type="button" class="btn btn-danger btn-modal" data-toggle="modal"
                                    data-target="#modalConfirm" data-product-id="{{ $product['id'] }}"
                                    data-user-id="{{ auth()->user()->id }}">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}

            @include('partials.modal_confirm_delete')
            @include('partials.modal_stock_del')
        @else
            <div class="d-flex align-items-center flex-column justify-content-center" style="height: 72vh">
                <i class="bi bi-box" style="font-size: 10rem; color: #e2e8f0;"></i>
                <h1 class="text-center" style="color: #e2e8f0;">Produk tidak ada</h1>
            </div>
        @endif
    </div>


@endsection
