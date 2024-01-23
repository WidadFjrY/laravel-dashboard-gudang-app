<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productTitle"></h5>
            </div>
            <div class="modal-body scrollable-modal-body">
                <div class="d-flex gap-2 align-items-center">
                    <img src="" id="productImgCtg" class="flex-item rounded-2 shadow-sm" width="300"
                        height="300" alt="" style="object-fit: cover">
                    <table class="table flex-item borderless">
                        <tbody>
                            <tr>
                                <th scope="row">Nama</th>
                                <td id="productName"></td>
                            </tr>
                            <tr>
                                <th scope="row">SKU</th>
                                <td id="productSKU"></td>
                            </tr>
                            <tr>
                                <th scope="row">Kategori</th>
                                <td id="productCategory"></td>
                            </tr>
                            <tr>
                                <th scope="row">Berat</th>
                                <td id="productWeight"></td>
                            </tr>
                            <tr>
                                <th scope="row">Stok</th>
                                <td id="productStock"></td>
                            </tr>
                            <tr>
                                <th scope="row">Harga</th>
                                <td id="productPrice"></td>
                            </tr>
                            <tr>
                                <th scope="row">Dibuat</th>
                                <td id="productCreatedAt"></td>
                            </tr>
                            <tr>
                                <th scope="row">Diubah</th>
                                <td id="productUpdatedAt"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h5>Deskripsi</h5>
                <p id="productDescription"></p>
            </div>
            <div class="modal-footer">
                <a href='' class="btn btn-primary" id="productUrl">Ubah</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
