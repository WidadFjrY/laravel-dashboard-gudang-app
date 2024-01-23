@extends('layouts.main')
@section('container')
    @include('partials.header')
    <div style="background-color: white; position: relative; top: -6rem" class="m-3 p-3 rounded-2 shadow-sm">
        <form action="/product/create/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex gap-3 align-items-center">
                <div class="flex-item" style="width: 100%">
                    <div class="form-floating mb-3">
                        <input required name="name" type="text"
                            class="form-control @error('name')
                            is-invalid
                        @enderror"
                            id="floatingInput" value="{{ old('name') }}">
                        <label for="floatingInput">Nama<span style="color: red">*</span></label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input required type="text" name="SKU"
                            class="form-control @error('SKU')
                            is-invalid
                        @enderror"
                            id="floatingSku" value="{{ old('SKU') }}">
                        <label for="floatingSku">SKU<span style="color: red">*</span></label>
                        @error('SKU')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="category_id" id="floatingCategory">
                            @foreach ($categories as $category)
                                <option value={{ $category->id }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingCategory">Kategori<span style="color: red">*</span></label>

                    </div>
                    <div class="form-floating mb-3">
                        <input required type="number" name="weight"
                            class="form-control @error('weight')
                            is-invalid
                        @enderror"
                            id="floatingWeight" value="{{ old('weight') }}">
                        <label for="floatingWeight">Berat (g)<span style="color: red">*</span></label>
                        @error('weight')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex gap-3">
                        <div class="form-floating flex-item" style="width: 50%">
                            <input required type="number" name="stock"
                                class="form-control @error('stock')
                                is-invalid
                            @enderror"
                                id="floatingStock" value="{{ old('stock') }}">
                            <label for="floatingStock">Stok<span style="color: red">*</span></label>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating flex-item" style="width: 50%">
                            <select class="form-select" name="unit_id" id="floatingUnit">
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingUnit">Satuan<span style="color: red">*</span></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center gap-3 mt-3">
                <div class="" style="width: 50%;">
                    <input required type="file" name="image"
                        class="form-control @error('image')
                    is-invalid
                @enderror"
                        id="image" accept="image/*" value="{{ old('image') }}">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3 flex-item" style="width: 50%">
                    <input required type="number" name="price"
                        class="form-control @error('price')
                        is-invalid
                    @enderror"
                        id="floatingPrice" value="{{ old('price') }}">
                    <label for="floatingPrice">Harga (IDR)<span style="color: red">*</span></label>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control @error('description')
                    is-invalid
                @enderror"
                    name="description" id="productDescription" style="height: 100px"></textarea>
                <label for="productDescription">Deskripsi (Optional)</label>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <a href="/products" class="btn btn-danger">Batal</a>
            <button type="submit" class="btn btn-success">Tambah Produk</button>
        </form>
    </div>
@endsection
