<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold"> New</span>
                    <span class="fw-light"> Company </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">
                    Add a new company
                </p>
                <form action="{{ route('company.submit') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Name</label>
                                <input id="addName" name="name" type="text" class="form-control"
                                    placeholder="fill name" />
                            </div>
                        </div>
                        <div class="col-md-6 pe-0">
                            <div class="form-group form-group-default">
                                <label>Address</label>
                                <input id="addAddress" name="address" type="text" class="form-control"
                                    placeholder="fill Address" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>City</label>
                                <input id="addCity" name="city" type="text" class="form-control"
                                    placeholder="fill City" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" id="modalTambah" class="btn btn-primary">
                            Add
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