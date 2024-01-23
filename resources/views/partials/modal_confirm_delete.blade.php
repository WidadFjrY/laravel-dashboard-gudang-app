<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Konfirmasi Hapus Prodouk</h5>
            </div>
            <div class="modal-body">
                <p class="m-0">Apakah yakin ingin menghapus produk <b id="productTitle"></b></p>
            </div>
            <form action="" method="POST" id="deleteProduct">
                @method('delete')
                @csrf
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
