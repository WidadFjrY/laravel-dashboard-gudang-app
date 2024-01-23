@extends('layouts.main')

@section('container')
    @include('partials.header')
    <div class="m-3 p-3 rounded-2 shadow-sm" style="position: relative; top: -6rem; background-color: white">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="position: absolute; z-index: 999; top: 0; left: 0; width: 100%">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="/users">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari berdasarkan Username/Nama/Email" name="search"
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit" id="search">Cari</button>
            </div>
        </form>
        <div class="d-flex align-items-center gap-2" style="position: relative; top: -0.4rem"><i
                class="bi bi-person flex-item" style="color: #475569"></i>
            <h6 class="m-0 text-dark flex-item" style="position: relative;">
                {{ count($users->items()) }} / {{ $users->total() }}</h6>
        </div>
        @if ($users->total() != 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Username</th>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Email</th>
                        <th scope="col" class="text-center">Role</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center" style="padding-top:1rem">{{ $loop->iteration }}</td>
                            <td class="text-center" style="padding-top:1rem">{{ $user['username'] }}</td>
                            <td class="text-center" style="padding-top:1rem">{{ $user['name'] }}</td>
                            <td class="text-center" style="padding-top:1rem">{{ $user['email'] }}</td>
                            <td class="text-center" style="padding-top:1rem">{{ $user['role'] }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info btn-modal-user" data-toggle="modal"
                                    data-target="#myModalUser" data-user-id="{{ $user['id'] }}">
                                    Detail
                                </button>
                                <button data-href="/user/update/{{ $user['username'] }}" type="button"
                                    class="btn btn-primary btn-update" data-user-id="{{ $user['id'] }}"
                                    {{ auth()->user()->role === 'Admin' || auth()->user()->username === $user['username'] ? '' : 'disabled' }}>
                                    Ubah
                                </button>
                                <script>
                                    $(document).ready(function() {
                                        $(".btn-update").click(function() {
                                            var href = $(this).data("href");
                                            window.location.href = href;
                                        });
                                    });
                                </script>
                                <button type="button" class="btn btn-danger btn-modal-user" data-toggle="modal"
                                    data-target="#modalConfirm" data-user-id="{{ $user['id'] }}"
                                    data-auth="{{ auth()->user()->id }}"
                                    {{ auth()->user()->role === 'Admin' && auth()->user()->username !== $user['username'] ? '' : 'disabled' }}>
                                    Hapus
                                </button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
            @if (auth()->user()->role === 'Admin')
                <a href="/user/create" class="btn btn-success">Tambah Pengguna</a>
                @include('partials.modal_confirm_delete_user')
            @endif
            @include('partials.modal_user')
    </div>
@else
    <div class="d-flex align-items-center flex-column justify-content-center" style="height: 72vh">
        <i class="bi bi-person" style="font-size: 10rem; color: #e2e8f0;"></i>
        <h1 class="text-center" style="color: #e2e8f0;">Pengguna tidak ada</h1>
        @if (auth()->user()->role === 'Admin')
            <a href="/user/create" class="btn btn-success mt-5">Tambah Pengguna</a>
        @endif
    </div>
    @endif
@endsection
