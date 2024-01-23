<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengguna</h5>
            </div>
            <form action="/user/create" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-floating m-3">
                    <input type="text"
                        class="form-control @error('name')
                        is-invalid
                    @enderror"
                        id="name_user" name="name" required>
                    <label for="name_user">Nama</label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating m-3">
                    <input type="text"
                        class="form-control @error('username')
                        is-invalid
                    @enderror"
                        id="username" name="username" required>
                    <label for="username">Username</label>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating m-3">
                    <input type="email"
                        class="form-control @error('email')
                        is-invalid
                    @enderror"
                        id="email_user" name="email" required>
                    <label for="email_user">Email</label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating m-3">
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
                <div class="form-floating m-3">
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
                <div class="m-3">
                    <select class="form-select" name="role" id="role">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="m-3" style="">
                    <input required type="file" name="image"
                        class="form-control @error('image') is-invalid @enderror" id="image" accept="image/*"
                        value="{{ old('image') }}">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="productUrl">Tambah</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
