@extends('layouts.main')
@section('container')
    @include('partials.header')
    <div style="background-color: white; position: relative; top: -6rem" class=" m-3 p-3 rounded-2 shadow-sm">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style=" width: 100%">
                <strong>Gagal</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="/user/create/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3 ">
                <input type="text"
                    class="form-control @error('name')
                    is-invalid
                    
                @enderror"
                    id="name_user" name="name" required value="{{ old('name') }}">
                <label for="name_user">Nama</label>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-floating mb-3 ">
                <input type="text"
                    class="form-control @error('username')
                    is-invalid
                @enderror"
                    id="username" name="username" required value="{{ old('username') }}">
                <label for="username">Username</label>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-floating mb-3 ">
                <input type="email"
                    class="form-control @error('email')
                    is-invalid
                @enderror"
                    id="email_user" name="email" required value="{{ old('email') }}">
                <label for="email_user">Email</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-floating mb-3 ">
                <input type="password"
                    class="form-control @error('password')
                    is-invalid
                @enderror"
                    id="password_user" name="password" required>
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
                    id="verificaion_user" name="verification" required>
                <label for="verificaion_user">Ulangi Kata Sandi</label>
                @error('verificaion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <select class="form-select" name="role" id="role">
                    <option value="Admin">Admin</option>
                    <option value="User">User</option>
                </select>
            </div>
            <div class="mb-3" style="">
                <input required type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                    id="image" accept="image/*" value="{{ old('image') }}">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="">
                <button type="submit" class="btn btn-success">Tambah</button>
                <a href="/users" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
@endsection
