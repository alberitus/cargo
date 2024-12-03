<div class="modal fade" id="modalTambahUser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold"> New</span>
                    <span class="fw-light"> User </span>
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">
                    Add a new user
                </p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Name</label>
                                <input id="addName" name="name" type="text" class="form-control" value="" placeholder="Enter name" />
                            </div>
                        </div>
                        <div class="col-md-6 pe-0">
                            <div class="form-group form-group-default">
                                <label>Email</label>
                                <input id="addEmail" name="email" type="email" class="form-control" placeholder="Enter email" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Password</label>
                                <input id="addPassword" name="password" type="password" class="form-control" placeholder="Enter password" />
                            </div>
                        </div>
                        <div class="col-md-6 pe-0">
                            <div class="form-group form-group-default">
                                <label>Role</label>
                                <select id="addRole" name="role" class="form-control">
                                    <option value="1">User</option>
                                    <option value="2">Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-hidden="true">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
