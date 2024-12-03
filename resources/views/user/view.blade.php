@extends('layout/template')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Profile</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="/">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="/profile">Profile</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="/profile">Update Profile</a>
            </li>
        </ul>
    </div>

    <!-- Profile Information Section -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <h3 class="fw-bold mb-3">Profile Information</h3>
                        <p>Update your account's profile information and email address.</p>

                        <div class="col-md-6 col-lg-2">
                            <div class="form-group">
                                <label class="mb-3"><b>Name</b></label>
                                <p class="form-control-static">{{ ucwords(Auth::user()->name) }}</p>
                            </div>
                            <div class="form-group">
                                <label class="mb-3"><b>Role</b></label>
                                <p class="form-control-static">{{ session('role_name', 'No role assigned') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="mb-3"><b>Email</b></label>
                                <p class="form-control-static">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-4">
                        <a href="/profile" class="btn btn-primary">Edit</a>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
