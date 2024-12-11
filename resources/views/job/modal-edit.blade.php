@foreach ($job as $J)
    <div class="modal fade" id="modalUbah{{ $J->job_id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Update</span>
                        <span class="fw-light">Job</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="small">
                        Update Job
                    </p>
                    <form action="{{ route('job.update', $J->job_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Name</label>
                                    <input id="addName" name="name_job" type="text" class="form-control"
                                        value="{{ $J->name_job }}" placeholder="Fill name" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Code</label>
                                    <input id="addJob" name="job_code" type="text" class="form-control"
                                        value="{{ $J->job_code }}" placeholder="Fill code" />
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
