@extends('layouts.main')

@section('container')
    @include('partials.header')
    <div style="background-color: white; position: relative; top: -6rem" class="m-3 p-3 rounded-2 shadow-sm">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style=" width: 100%">
                <strong>Gagal</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="/user/update/{{ $user['id'] }}/{{ auth()->user()->id }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="d-flex align-items-center gap-3 mb-3">
                @php
                    $profle_picture = $user['url_picture'];
                @endphp
                <img src="{{ asset("storage/$profle_picture") }}" class="flex-item rounded-2" width="250" height="250"
                    style="object-fit: cover" alt="">
                <div class="flex-item" style="width: 100%">
                    <div class="form-floating mb-3 ">
                        <input type="text"
                            class="form-control @error('name')
                        is-invalid
                    @enderror"
                            id="name_user" name="name" value="{{ $user['name'] }}" required>
                        <label for="name_user">Nama</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3 ">
                        <input type="text" disabled
                            class="form-control @error('username')
                        is-invalid
                    @enderror"
                            id="username" name="username" value="{{ $user['username'] }}" required>
                        <label for="username">Username</label>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3 ">
                        <input type="email" disabled
                            class="form-control @error('email')
                        is-invalid
                    @enderror"
                            id="email_user" name="email" value="{{ $user['email'] }}" required>
                        <label for="email_user">Email</label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3" style="">
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                    id="image" accept="image/*" value="{{ old('image') }}">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3 ">
                <input type="password"
                    class="form-control @error('password')
                is-invalid
            @enderror"
                    id="password_user" name="password">
                <label for="password_user">Kata Sandi</label>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-floating mb-3 ">
                <input type="password"
                    class="form-control @error('verificaion')
                is-invalid
            @enderror"
                    id="verificaion_user" name="verification">
                <label for="verificaion_user">Ulangi Kata Sandi</label>
                @error('verificaion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <select class="form-select" name="role" id="role">
                    <option value="Admin" {{ $user['role'] === 'Admin' ? 'selected="selected"' : '' }}>Admin</option>
                    <option value="User" {{ $user['role'] === 'User' ? 'selected="selected"' : '' }}>User</option>
                </select>

            </div>

            <div class="">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="/users" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
@endsection
