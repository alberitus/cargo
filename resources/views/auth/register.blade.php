<!-- Modal Add User -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold"> Add</span>
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
                <form method="POST" action="{{ route('user.submit') }}">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Enter name" required />
                    </div>

                    <!-- Email -->
                    <div class="form-group mt-3">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" class="form-control" placeholder="Enter email" required />
                    </div>

                    <!-- Password -->
                    <div class="form-group mt-3">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" class="form-control" placeholder="Enter password" required />
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group mt-3">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Confirm password" required />
                    </div>

                    <!-- Role -->
                    <div class="form-group mt-3">
                        <label for="role">Role</label>
                        <select id="role" name="role" class="form-control" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">
                            Add User
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
