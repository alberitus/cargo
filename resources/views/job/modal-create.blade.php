<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold"> New</span>
                    <span class="fw-light"> Job </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">
                    Add a new Job
                </p>
                <form action="{{ route('job.submit') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Name Job</label>
                                <input id="addName" name="job_name" type="text" class="form-control"
                                    placeholder="fill name" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Code</label>
                                <input id="addCode" name="job_code" type="text" class="form-control"
                                    placeholder="fill Code" />
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