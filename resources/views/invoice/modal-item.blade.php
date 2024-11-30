<div class="modal fae" id="modalItem" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle" id="exampleModalToggleLabel">DATA ITEM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <!-- Tabel Buku -->
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Nama Item</th>
                            <th width="30%">Harga</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>1</td>
                                <td>HANDLING</td>
                                <td>Rp 140.000</td>
                                <td>
                                    <button onclick="" class="btn btn-success"><i class="fas fa-cart-plus"></i>Tambahkan</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>PICK UP DOKUMEN</td>
                                <td>Rp 10.000</td>
                                <td>
                                    <button onclick="" class="btn btn-success"><i class="fas fa-cart-plus"></i>Tambahkan</button>
                                </td>
                            </tr>
                    </tbody>
                </table>
                <!-- -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUbah" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle" id="exampleModalToggleLabel">UBAH JUMLAH ITEM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <div class="row mt-3">
                    <div class="col-sm-7">
                        <input type="hidden" id="rowid">
                        <input type="number" id="qty" class="form-control" placeholder="Masukan Jumlah Produk" min="1" value="1">
                    </div>
                    <div class="col-sm-5">
                        <button class="btn btn-primary" onclick="update_cart()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Tambah
    function add_cart(id, name, price, discount) {
        $.ajax({
            url: "/jual",
            method: "POST",
            data: {
                id: id,
                name: name,
                qty: 1,
                price: price,
                discount: discount,
            },
            success: function(data) {
                load()
            }
        });
    }

    // Update
    function update_cart() {
        var rowid = $('#rowid').val();
        var qty = $('#qty').val();

        $.ajax({
            url: "/jual/update",
            method: "POST",
            data: {
                rowid: rowid,
                qty: qty,
            },
            success: function(data) {
                load();
                $('#modalUbah').modal('hide');
            }
        });
    }
</script>