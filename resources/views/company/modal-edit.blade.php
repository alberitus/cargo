@foreach ($company as $data)
    <div class="modal fade" id="modalUbah{{ $data->company_id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Update</span>
                        <span class="fw-light">Company</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="small">
                        Update company
                    </p>
                    <!-- Perhatikan route harus sesuai dengan id perusahaan -->
                    <form action="{{ route('company.update', $data->company_id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Untuk method update -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Name</label>
                                    <input id="addName" name="name" type="text" class="form-control"
                                        value="{{ $data->name }}" placeholder="Fill name" />
                                </div>
                            </div>
                            <div class="col-md-6 pe-0">
                                <div class="form-group form-group-default">
                                    <label>Code</label>
                                    <input id="addCode" name="code_name" type="text" class="form-control"
                                        value="{{ $data->code_name }}" placeholder="Fill Code" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Contact</label>
                                    <input id="addContact" name="contact" type="text" class="form-control"
                                        value="{{ $data->contact }}" placeholder="Fill contact" />
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
