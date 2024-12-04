<div class="container-fluid">
    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
        <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"
                aria-haspopup="true">
                <i class="fa fa-search"></i>
            </a>
            <ul class="dropdown-menu dropdown-search animated fadeIn">
                <form class="navbar-left navbar-form nav-search">
                    <div class="input-group">
                        <input type="text" placeholder="Search ..." class="form-control">
                    </div>
                </form>
            </ul>
        </li>
        <li class="nav-item topbar-icon dropdown hidden-caret">
            <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell"></i>
                <span class="notification">4</span>
            </a>
            <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                <li>
                    <div class="dropdown-title">
                        You have new notification
                    </div>
                </li>
                <li>
                    <div class="notif-scroll scrollbar-outer">
                        <div class="notif-center">
                            <a href="#">
                                <div class="notif-icon notif-primary">
                                    <i class="fa fa-user-plus"></i>
                                </div>
                                <div class="notif-content">
                                    <span class="block"> New order </span>
                                    <span class="time">5 minutes ago</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item topbar-user dropdown hidden-caret">
            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                <div class="avatar-sm">
                    <img src="{{ asset('import/assets/img/profile.png') }}" alt="..."
                        class="avatar-img rounded-circle" />
                </div>
                <span class="profile-username">
                    <span class="op-7">Hi,</span>
                    <span class="fw-bold">{{ ucwords(Auth::user()->name) }}</span>
                </span>
            </a>
            <ul class="dropdown-menu dropdown-user animated fadeIn">
                <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                        <div class="user-box">
                            <div class="avatar-lg">
                                <img src="{{ asset('import/assets/img/profile.png') }}" alt="image profile"
                                    class="avatar-img rounded" />
                            </div>
                            <div class="u-text">
                                <h4>User</h4>
                                <p class="text-muted">{{ Auth::user()->email }}</p>
                                <a href="/profile/view" class="btn btn-xs btn-secondary btn-sm">View
                                    Profile</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/profile">Account Setting</a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="route('logout')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </li>
                </div>
            </ul>
        </li>
    </ul>
</div>
