<div class="modal fade" id="modalStock" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="POST" id="update-stock">
            @csrf
            @method('put')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title"></h5>
                </div>
                <div class="modal-body scrollable-modal-body">
                    <p>Stock sebelumnya <span id="productStock"></span></p>
                    <div class="form-floating mb-3 flex-item" style="width: 50%">
                        <input type="number" name="stock" class="form-control" id="floatingStock"
                            onchange="validateStockInput()" value="0">
                        <label for="floatingStock">{{ $option }}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="resetInputStock()">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="resetInputStock()">Tutup</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function validateStockInput() {
        const stockInput = document.getElementById('floatingStock');
        const enteredValue = parseInt(stockInput.value);

        // Jika nilai yang dimasukkan kurang dari 0, atur nilainya menjadi 0
        if (enteredValue < 0) {
            stockInput.value = 0;
        }
    }

    function resetInputStock() {
        const stockInput = document.getElementById('floatingStock');
        setTimeout(() => {
            stockInput.value = 0
        }, 300);
    }
</script>
