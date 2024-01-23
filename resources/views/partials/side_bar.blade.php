<div class="d-flex flex-column flex-shrink-0 p-3 vh-100 bg-body-tertiary shadow" style="width: 280px; position: fixed">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <span class="fs-4">Info Gudang</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <a href="/"
                class="nav-link {{ $title === 'Dashboard' ? 'active' : 'link-body-emphasis' }} d-inline-flex align-items-center gap-3"
                style="width: 100%">
                <i class="bi bi-house-door-fill flex-item"
                    style="color: {{ $title === 'Dashboard' ? 'white' : 'black' }}; font-size: 20px;"></i>
                Dashboard </a>
        </li>
        <h5 class="mt-3">Master</h5>
        <li>
            <a href="#"
                class="product-link m-0 nav-link {{ $title === 'Produk' || $title === 'Kategori Produk' || $title === 'Data Satuan' ? 'active' : 'link-body-emphasis' }}
                d-inline-flex align-items-center gap-3"
                style="width: 100%">
                <i class="bi bi-box-seam-fill flex-item "
                    style="color: {{ $title === 'Produk' || $title === 'Kategori Produk' || $title === 'Data Satuan' ? 'white' : 'black' }}; font-size: 20px;"></i>
                Produk
            </a>
            <div class="product-options" style="display: none;">
                <ul class="ml-2" style="list-style-type: none;">
                    <li><a href="/products"
                            class="dropdown-item nav-link link-body-emphasis {{ $title === 'Produk' ? 'text-primary' : 'link-body-emphasis' }}"
                            style="font-size: 0.9rem; margin-left: 1rem">Data
                            Produk</a></li>
                    <li>
                        <a href="/categories"
                            class="dropdown-item nav-link mt-2 {{ $title === 'Kategori Produk' ? 'text-primary' : 'link-body-emphasis' }}"
                            style="font-size: 0.9rem; margin-left: 1rem">Jenis
                            Produk</a>
                    </li>
                    <li>
                        <a href="/units"
                            class="dropdown-item nav-link  mt-2 {{ $title === 'Data Satuan' ? 'text-primary' : 'link-body-emphasis' }}"
                            style="font-size: 0.9rem; margin-left: 1rem">Data
                            Satuan</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="mt-2">
            <a href="/users"
                class="nav-link {{ $title === 'Pengguna' || $title === 'Tambah Pengguna' ? 'active' : 'link-body-emphasis' }} d-inline-flex align-items-center gap-3"
                style="width: 100%">
                <i class="bi bi-people-fill flex-item "
                    style="color: {{ $title === 'Pengguna' || $title === 'Tambah Pengguna' ? 'white' : 'black' }}; font-size: 20px;"></i>Pengguna
            </a>
        </li>
        <h5 class="mt-4">Transaksi</h5>
        <li class="mt-2">
            <a href="/product-in"
                class="nav-link {{ $title === 'Produk Masuk' || $title === 'Tambah Produk' ? 'active' : 'link-body-emphasis' }} d-inline-flex align-items-center gap-3"
                style="width: 100%">
                <i class="bi bi-box-arrow-in-down-right flex-item "
                    style="color: {{ $title === 'Produk Masuk' || $title === 'Tambah Produk' ? 'white' : 'black' }}; font-size: 20px;"></i>Produk
                Masuk
            </a>
        </li>
        <li class="mt-2">
            <a href="/product-out"
                class="nav-link {{ $title === 'Produk Keluar' ? 'active' : 'link-body-emphasis' }} d-inline-flex align-items-center gap-3"
                style="width: 100%">
                <i class="bi bi-box-arrow-up-left flex-item "
                    style="color: {{ $title === 'Produk Keluar' ? 'white' : 'black' }}; font-size: 20px;"></i>Produk
                Keluar
            </a>
        </li>
        <h5 class="mt-4">Laporan</h5>
        <li class="mt-2">
            <a href="/reports"
                class="nav-link {{ str_contains($title, 'Laporan Bulanan') ? 'active' : 'link-body-emphasis' }} d-inline-flex align-items-center gap-3"
                style="width: 100%">
                <i class="bi bi-file-earmark-richtext flex-item "
                    style="color: {{ str_contains($title, 'Laporan Bulanan') ? 'white' : 'black' }}; font-size: 20px;"></i>
                Laporan Bulanan
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
            data-bs-toggle="dropdown" aria-expanded="false">
            @php
                $user = auth()->user()->url_picture;
            @endphp
            <img src="{{ asset("storage/$user") }}" alt="" width="32" height="32"
                style="object-fit: cover" class="rounded-circle me-2">
            <strong>{{ explode(' ', auth()->user()->name)[0] }}</strong>
        </a>
        <ul class="dropdown-menu text-small shadow">
            <form action="/logout" method="POST" class="dropdown-item">
                @csrf
                <button class="btn"
                    style="border: none; background-color: transparent; cursor: pointer; width: 100%">Log
                    out</button>
            </form>
        </ul>
    </div>
</div>
