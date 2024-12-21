<div class="modal fade" id="modalUbahCost" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle" id="exampleModalToggleLabel">UBAH JUMLAH ITEM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <div class="row mt-3">
                    <div class="col-sm-7">
                        <input type="hidden" id="item_id">
                        <input type="number" id="qty" class="form-control" placeholder="Masukan Jumlah Produk" min="1" value="1">
                    </div>
                    <div class="col-sm-5">
                        <button class="btn btn-primary" type="button" onclick="update_cost()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>