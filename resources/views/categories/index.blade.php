@extends('layouts.main')

@section('container')
    @include('partials.header')
    <div class="m-3 p-3 rounded-2 shadow-sm" style="position: relative; top: -6rem; background-color: white">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="position: absolute; z-index: 999; top: 0; left: 0; width: 100%">
                <strong>Berhasil</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="/categories">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari nama kategori" name="search"
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit" id="search">Cari</button>
            </div>
        </form>
        <div class="d-flex align-items-center gap-2" style="position: relative; top: -0.4rem"><i
                class="bi {{ $icon }} flex-item" style="color: #475569"></i>
            <h6 class="m-0 text-dark flex-item" style="position: relative;">
                {{ count($categories->items()) }} / {{ $categories->total() }}</h6>
        </div>
        @if ($categories->total() != 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Dibuat</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="text-center" style="padding-top:1rem">{{ $loop->iteration }}</td>
                            <td class="text-center" style="padding-top:1rem">{{ $category['name'] }}</td>
                            <td class="text-center" style="padding-top:1rem">{{ $category['created_at'] }}</td>
                            <td class="text-center">
                                <a href="/category/{{ $category['slug'] }}" class="btn btn-success">Lihat</a>
                                <button type="button" class="btn btn-primary btn-modal-update-category"
                                    data-category-id="{{ $category['id'] }}" data-user-id="{{ auth()->user()->id }}"
                                    data-toggle="modal" data-target="#myModalUpdateCategory">
                                    Ubah
                                </button>
                                <button type="button" class="btn btn-danger btn-modal-category"
                                    data-category-id="{{ $category['id'] }}" data-toggle="modal"
                                    data-user-id="{{ auth()->user()->id }}" data-target="#myModalCategory">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-success btn-modal" data-toggle="modal" data-target="#myModal">
                    Tambah Kategori
                </button>
                {{ $categories->links() }}
            </div>
        @else
            <button type="button" class="btn btn-success btn-modal mt-2" data-toggle="modal" data-target="#myModal">
                Tambah Kategori
            </button>
            <div class="d-flex align-items-center flex-column justify-content-center" style="height: 66vh">
                <i class="bi {{ $icon }}" style="font-size: 10rem; color: #e2e8f0;"></i>
                <h1 class="text-center" style="color: #e2e8f0;">Kategori tidak ada</h1>
            </div>
        @endif
        @include('partials.modal_update_category')
        @include('partials.modal_create_category')
        @include('partials.modal_confirm_delete_category')

    </div>
@endsection
