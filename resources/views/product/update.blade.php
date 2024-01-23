@extends('layouts.main')

@section('container')
    @include('partials.header')
    <div style="background-color: white; position: relative; top: -6rem" class="m-3 p-3 rounded-2 shadow-sm">
        <h4>Update Produk</h4>
        <form action="/product/update/{{ $product->SKU }}/{{ auth()->user()->id }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="d-flex gap-3 align-items-center" style="margin-top: 1rem !important">
                <img src="/storage/{{ $product->url_picture }}" class="flex-item rounded-2" width="300" height="300"
                    alt="">
                <div class="flex-item" style="width: 100%">
                    <div class="form-floating mb-3">
                        <input type="text"
                            class="form-control  @error('name')
                        is-invalid
                    @enderror"
                            name="name" id="floatingInput" value="{{ $product->name }}">
                        <label for="floatingInput">Nama</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input disabled type="text" name="SKU"
                            class="form-control  @error('SKU')
                        is-invalid
                    @enderror"
                            id="floatingSku" value="{{ $product->SKU }}">
                        <label for="floatingSku">SKU</label>
                        @error('SKU')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="category_id" id="floatingCategory">
                            @foreach ($categories as $category)
                                @if ($category->name == $product->category->name)
                                    <option selected value={{ $category->id }}>{{ $category->name }}</option>
                                @else
                                    <option value={{ $category->id }}>{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="floatingCategory">Kategori</label>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="form-floating flex-item" style="width: 50%">
                            <input type="number"
                                class="form-control  @error('weight')
                            is-invalid
                        @enderror"
                                name="weight" id="floatingWeight" value="{{ $product->weight }}">
                            <label for="floatingWeight">Berat (g)</label>
                            @error('weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating flex-item" style="width: 50%">
                            <select class="form-select" name="unit_id" id="floatingUnit">
                                @foreach ($units as $unit)
                                    @if ($unit->name == $product->unit->name)
                                        <option selected value={{ $unit->id }}>{{ $unit->name }}</option>
                                    @else
                                        <option value={{ $unit->id }}>{{ $unit->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="floatingUnit">Satuan</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center gap-3 mt-3">
                <div class="input-group  mb-3 flex-item" style="width: 50%; height: 50%">
                    <input type="file"
                        class="form-control  @error('image')
                    is-invalid
                @enderror"
                        name="image" id="productImg" accept="image/*">
                    <label class="input-group-text" for="productImg">Ganti foto produk</label>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3 flex-item" style="width: 50%">
                    <input type="number" name="price"
                        class="form-control  @error('price')
                    is-invalid
                @enderror"
                        id="floatingPrice" value="{{ $product->price }}">
                    <label for="floatingPrice">Harga (IDR)</label>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="desc" id="productDescription" style="height: 100px">{{ $product->description }}</textarea>
                <label for="productDescription">Deskripsi</label>
            </div>
            <a href="/products" class="btn btn-danger">Batal</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
