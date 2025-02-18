@foreach ($item as $data)
    <div class="modal fade" id="modalUbah{{ $data->item_id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Update</span>
                        <span class="fw-light">Item</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="small">
                        Update item
                    </p>
                    <!-- Perhatikan route harus sesuai dengan id perusahaan -->
                    <form action="{{ route('item.update', $data->item_id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Untuk method update -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Nama Item</label>
                                    <input id="nama_item" name="nama_item" type="text" class="form-control"
                                        value="{{ $data->nama_item }}" placeholder="Nama Item" />
                                </div>
                            </div>
                            <div class="col-md-6 pe-0">
                                <div class="form-group form-group-default">
                                    <label>Quantity</label>
                                    <input id="qty" name="qty" type="text" class="form-control"
                                        value="{{ $data->qty }}" placeholder="Quantity" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Satuan</label>
                                    <input id="satuan" name="satuan" type="text" class="form-control"
                                        value="{{ $data->Satuan }}" placeholder="Satuan" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-hidden="true">
                                Close
                            </button>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
