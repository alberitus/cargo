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
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <form method="post" action="{{ route('profile.updateById', ['id' => $user->id]) }}"
                        class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div class="row">
                            <h3 class="fw-bold mb-3">Profile Information</h3>
                            <p>Update your account's profile information and email address.</p>

                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', $user->email) }}" required autocomplete="username">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !
                                $user->hasVerifiedEmail())
                                <div>
                                    <p class="text-sm mt-2 text-gray-800">
                                        {{ __('Your email address is unverified.') }}
                                        <button form="send-verification"
                                            class="btn btn-link p-0 text-sm text-gray-600 hover:text-gray-900">
                                            {{ __('Click here to re-send the verification email.') }}
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-success">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                    @endif
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-select form-control" id="role" name="role">
                                        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Customer Service
                                        </option>
                                        <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Admin</option>
                                        <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>Supervisor
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-4">
                            <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>

                            @if (session('status') === 'profile-updated')
                            <p class="text-success mt-2">
                                {{ __('Saved.') }}
                            </p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Password Section -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('password.updateByID', ['id' => $user->id]) }}"
                        class="space-y-6">
                        @csrf
                        @method('put')

                        <h3 class="fw-bold mb-3">Update Passwords</h3>
                        <p>Ensure your account is using a long, random password to stay secure.</p>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control" id="current_password"
                                    name="current_password" autocomplete="current-password">
                                @error('current_password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    autocomplete="new-password">
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" autocomplete="new-password">
                                @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex align-items-center gap-4">
                                <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>

                                @if (session('status') === 'password-updated')
                                <p class="text-success mt-2">
                                    {{ __('Saved.') }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Reset Password Section -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <section class="space-y-6">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Reset Password') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Click the button below to reset the password for this account to "admin1234".') }}
                            </p>
                        </header>

                        <!-- Tombol Reset Password -->
                        <form action="{{ route('reset.password', ['id' => $user->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-warning">
                                {{ __('Reset Password') }}
                            </button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Section -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <section class="space-y-6">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Delete Account') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                            </p>
                        </header>

                        <!-- Tombol untuk memicu modal -->
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeletionModal">
                            {{ __('Delete Account') }}
                        </button>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="confirmDeletionModal" tabindex="-1" aria-labelledby="confirmDeletionLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeletionLabel">
                        {{ __('Confirm Account Deletion') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body Modal -->
                <div class="modal-body">
                    <p>
                        {{ __('Once this account is deleted, all of its resources and data will be permanently deleted. This action cannot be undone.') }}
                    </p>

                    <!-- Form Konfirmasi Hapus -->
                    <form method="POST" action="{{ route('profile.destroyById', ['id' => $user->id]) }}">
                        @csrf
                        @method('DELETE')

                        <!-- Footer Modal -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-danger">
                                {{ __('Delete Account') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
