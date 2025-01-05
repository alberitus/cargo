@foreach ($faktur as $invoice)
    <div class="modal fade" id="modalFaktur{{ $invoice->transaction_id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Input</span>
                        <span class="fw-light">Faktur {{ $invoice->transaction_id }}</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('faktur.update', $invoice->transaction_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Faktur</label>
                                    <input id="addFaktur" name="faktur" type="text" class="form-control" placeholder="Fill Faktur" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" class="btn btn-primary">
                                Input
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
