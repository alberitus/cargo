<div class="container">
    <div class="row">
        <div class="d-grid gap-3 d-md-flex justify-content-md-end">
            <button class="btn btn-primary" type="button" data-bs-target="#modalCost"
                data-bs-toggle="modal">Pilih
                Item</button>
        </div>
    </div>
</div>
<table id="costTable" class="table table-striped table-hover mt-4">
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
    <tbody id="detail_cost">
    </tbody>
</table>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-8">
            <div class="d-grip gap-3 d-md-flex justify-content-md-end">
                <h6>TOTAL COST</h6>
            </div>
            <div class="d-grip gap-3 d-md-flex justify-content-md-end">
                <h6>GROSS PROFIT</h6>
            </div>
            <div class="d-grip gap-3 d-md-flex justify-content-md-end">
                <h6>PPH 23</h6>
            </div>
            <div class="d-grip gap-3 d-md-flex justify-content-md-end">
                <h5>PROFIT</h5>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="d-flex justify-content-center">
                <h5 style="width: 80%; text-align: left;" id="total-cost">RP 0</h5>
            </div>
            <div class="d-flex justify-content-center">
                <h6 style="width: 80%; text-align: left;" id="gross-profit">RP
                    0</h6>
            </div>
            <div class="d-flex justify-content-center">
                <h6 style="width: 80%; text-align: left;" id="pph23">RP
                    0</h6>
            </div>
            <div class="d-flex justify-content-center">
                <h5 style="width: 80%; text-align: left;" id="profit">RP
                    0</h5>
            </div>
        </div>
    </div>
</div>