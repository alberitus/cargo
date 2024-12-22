<div class="modal fade" id="modalCost" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1"> 
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">ITEM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Item</th>
                            <th width="30%">Satuan</th>
                            <th width="30%">Harga</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach ($itemCost as $itemcost)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $itemcost->nama_item }}</td>
                            <td>{{ $itemcost->satuan }}</td>
                            <td>
                                <input type="number" class="form-control" id="cost-price-{{ $itemcost->item_id }}" placeholder="Masukkan Harga" min="0" value="0">
                            </td>
                            <td>
                                <button onclick="add_cost('{{ $itemcost->item_id }}', '{{ $itemcost->nama_item }}', '{{ $itemcost->satuan }}')" class="btn btn-success">
                                    <i class="fas fa-cart-plus"></i> Tambahkan
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>