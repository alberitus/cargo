@extends('layout/template')

@section('content')
<div class="page-inner">
    <h3 class="fw-bold mb-3">Create New Account</h3>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.create-account') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Customer Service</option>
                        <option value="2" {{ old('role') == 2 ? 'selected' : '' }}>Admin</option>
                        <option value="3" {{ old('role') == 3 ? 'selected' : '' }}>Supervisor</option>
                    </select>
                    
                </div>

                <button type="submit" class="btn btn-primary mt-3">Create Account</button>
            </form>
        </div>
    </div>
</div>
@endsection
