<div class="modal fade" id="modalConfirmHistory" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Konfirmasi Hapus Semua Riwayat</h5>
            </div>
            <div class="modal-body">
                <p class="m-0">Apakah yakin ingin menghapus semua riwayat?</p>
            </div>
            <form action="/histories" method="POST" id="deleteProduct">
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
