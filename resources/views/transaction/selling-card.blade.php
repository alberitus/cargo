<div class="container">
    <div class="row align-items-center">
        <div class="col-auto">
            <label class="col-form-label">Tanggal:</label>
            <input type="text" value="<?= date('d/m/y') ?>" class="form-control" disabled
                style="height: 38px;">
        </div>
        <div class="col-auto">
            <div class="form-group">
                <label class="form-label">Faktur</label>
                <div class="selectgroup w-100" style="height: 38px;">
                    <label class="selectgroup-item">
                        <input type="radio" name="stsfaktur" value="0" class="selectgroup-input"
                            checked="" />
                        <span class="selectgroup-button">No</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="stsfaktur" value="1"
                            class="selectgroup-input" />
                        <span class="selectgroup-button">Yes</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-auto  ms-auto">
            <button class="btn btn-primary" type="button" data-bs-target="#modalCart"
                data-bs-toggle="modal" style="height: 38px;">Pilih Item</button>
        </div>
    </div>
</div>
<table id="cartTable" class="table table-striped table-hover mt-4">
    <thead>
        <tr>
            <th>No</th>
            <th>Item</th>
            <th>QTY</th>
            <th>Satuan</th>
            <th>Harga Satuan</th>
            <th>Harga Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="detail_cart">
    </tbody>
</table>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label>TAX</label><br />
                <div class="d-flex">
                    <div class="form-check">
                        <input class="form-check-input tax-radio" type="radio" name="tax"
                            id="tax1" value="1.1" />
                        <label class="form-check-label" for="tax1">
                            1.1%
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input tax-radio" type="radio" name="tax"
                            id="tax2" value="11" checked />
                        <label class="form-check-label" for="tax2">
                            11%
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input tax-radio" type="radio" name="tax"
                            id="tax3" value="0" checked />
                        <label class="form-check-label" for="tax3">
                            No PPN
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="d-grip gap-3 d-md-flex justify-content-md-end">
                <h5>TOTAL HARGA</h5>
            </div>
            <div class="d-grip gap-3 d-md-flex justify-content-md-end">
                <h5 id="tax-label">TAX</h5>
            </div>
            <div class="d-grip gap-3 d-md-flex justify-content-md-end">
                <h5>GRAND TOTAL</h5>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="d-flex justify-content-center">
                <h5 style="width: 80%; text-align: left;" id="total-harga">RP 0</h5>
            </div>
            <div class="d-flex justify-content-center">
                <h5 id="tax-value" style="width: 80%; text-align: left;">RP 0</h5>
                <input type="hidden" id="tax-price-input" name="tax_price" value="0">
            </div>

            <div class="d-flex justify-content-center">
                <h5 style="width: 80%; text-align: left;" name="total" id="grand-total">RP 0
                </h5>
            </div>
        </div>
    </div>
</div>