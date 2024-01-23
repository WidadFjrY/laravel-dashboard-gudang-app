@extends('layouts.main')
@section('container')
    @include('partials.header')
    <div class="m-3 p-3 rounded-2 shadow-sm"
        style="position: relative; top: -6rem; background-color: white; margin-bottom: 10rem !important;">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="position: absolute; z-index: 999; top: 0; left: 0; width: 100%">
                <strong>Berhasil</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <a href="/" class="text-decoration-none">
            <i class="bi bi-arrow-left"></i> Kembali</a>
        <form action="/histories">
            <div class="input-group mt-3 mb-3">
                <input type="text" class="form-control" placeholder="Cari berdasarkan Aksi" name="search"
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit" id="search">Cari</button>
            </div>
        </form>
        <div class="">
            @if (count($histories) != 0)
                @foreach ($histories as $history)
                    <p><b>{{ $history['updated_at'] }}</b> {{ $history->user->name }} {!! explode('pada', $history['action'])[0] !!}</p>
                @endforeach
            @else
                <div class="d-flex justify-content-center align-items-center" style="height: 100%; width: 100%">
                    <p class="text-center" style="color: rgb(214, 214, 214) !important">Belum ada Riwayat
                    </p>
                </div>
            @endif
            @if (auth()->user()->role === 'Admin' && count($histories) != 0)
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalConfirmHistory">
                    Hapus
                </button>
                @include('partials.modal_confirm_delete_history')
            @endif
            {{ $histories->links() }}
        </div>
    </div>
@endsection
