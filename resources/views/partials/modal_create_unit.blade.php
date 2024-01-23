<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Satuan</h5>
            </div>
            <form action="/unit/create/{{ auth()->user()->id }}" method="POST">
                @csrf
                <div class="form-floating m-3">
                    <input type="text"
                        class="form-control @error('name')
                        is-invalid
                    @enderror"
                        id="name_unit" name="new_unit" required>
                    <label for="name_unit">Nama Satuan</label>
                    @error('name')
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
