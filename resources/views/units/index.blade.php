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
        <form action="/units">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari berdasarkan Nama" name="search"
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit" id="search">Cari</button>
            </div>
        </form>
        <div class="d-flex align-items-center gap-2" style="position: relative; top: -0.4rem"><i
                class="bi bi-layers flex-item" style="color: #475569"></i>
            <h6 class="m-0 text-dark flex-item" style="position: relative;">
                {{ count($units->items()) }} / {{ $units->total() }}</h6>
        </div>
        @if ($units->total() != 0)
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
                    @foreach ($units as $unit)
                        <tr>
                            <td class="text-center" style="padding-top:1rem">{{ $loop->iteration }}</td>
                            <td class="text-center" style="padding-top:1rem">{{ $unit['name'] }}</td>
                            <td class="text-center" style="padding-top:1rem">{{ $unit['created_at'] }}</td>
                            <td class="text-center">
                                <a href="/unit/{{ $unit['slug'] }}" class="btn btn-success">Lihat</a>
                                <button type="button" class="btn btn-primary btn-modal-update-unit"
                                    data-unit-id="{{ $unit['id'] }}" data-user-id="{{ auth()->user()->id }}"
                                    data-toggle="modal" data-target="#myModalUpdateUnit">
                                    Ubah
                                </button>
                                <button type="button" class="btn btn-danger btn-modal-unit"
                                    data-unit-id="{{ $unit['id'] }}" data-user-id="{{ auth()->user()->id }}"
                                    data-toggle="modal" data-target="#myModalUnit">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-success btn-modal" data-toggle="modal" data-target="#myModal">
                    Tambah Unit
                </button>
                {{ $units->links() }}
            </div>
        @else
            <button type="button" class="btn btn-success btn-modal mt-2" data-toggle="modal" data-target="#myModal">
                Tambah Unit
            </button>
            <div class="d-flex align-items-center flex-column justify-content-center" style="height: 66vh">
                <i class="bi bi-stack" style="font-size: 10rem; color: #e2e8f0;"></i>
                <h1 class="text-center" style="color: #e2e8f0;">Satuan tidak ada</h1>
            </div>
        @endif
        @include('partials.modal_confirm_delete_unit')
        @include('partials.modal_update_unit')
        @include('partials.modal_create_unit')
    </div>
@endsection
