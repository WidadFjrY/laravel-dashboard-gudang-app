<div class="modal fade" id="myModalUnit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Konfirmasi Hapus Satuan</h5>
            </div>
            <div class="modal-body d-flex align-items-center">
                <p id="errorGet" class="text-danger m-0"></p>
                <p id="confirmDelete" class="m-0" style="margin-right: 5px !important"> </p><b id="name"></b>
            </div>
            <form action="" method="POST" id="deleteUnit">
                @method('delete')
                @csrf
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="btn-delete" disabled>Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
