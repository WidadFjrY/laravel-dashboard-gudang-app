<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- MyStyle --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>Cashier App | {{ $title }}</title>

    <!-- Tambahkan skrip JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>{{ $title }}</title>
</head>

<body>
    <div class="d-flex align-content-center justify-content-center" style="height: 100vh">
        <div class="flex-item d-flex flex-column align-items-center justify-content-center" style="width: 50%">
            <img src="{{ asset('assets/img/packages.png') }}" width="400" alt="">
        </div>

        <div class="flex-item d-flex justify-content-center align-items-center" style="width: 50%">
            <form action="/login" method="POST" class="p-3 m-3 shadow-sm rounded-2 border border-primary"
                style="width: 50%; background-color: white">
                @csrf
                <div class="d-flex align-items-center gap-3">
                    <i class="bi {{ $icon }} flex-item" style="color: black; font-size: 24px;"></i>
                    <h4 class="text-dark flex-item m-0">{{ $title }}</h4>
                </div>
                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                        {{ session('loginError') }}
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="form-floating mb-3 mt-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                    <label for="email">Email</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Kata Sandi"
                        required>
                    <label for="password">Kata Sandi</label>
                </div>
                <button class="btn btn-success" type="submit">Masuk</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('script/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
