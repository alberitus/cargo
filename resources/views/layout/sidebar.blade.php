<div class="sidebar-content">
    <ul class="nav nav-secondary">
        <li class="nav-item">
            <a href="/">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-section">
            <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Components</h4>
        </li>
        @if(Auth::user()->role == 2) <!-- Role 2 is Admin -->
        <li class="nav-item">
            <a data-bs-toggle="collapse" href="#base">
                <i class="fas fa-layer-group"></i>
                <p>Company</p>
                <span class="caret"></span>
            </a>
            <div class="collapse" id="base">
                <ul class="nav nav-collapse">
                    <li>
                        <a href="/company">
                            <span class="sub-item">Company List</span>
                        </a>
                    </li>
                    <li>
                        <a href="/job">
                            <span class="sub-item">Job List</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @endif
        <li class="nav-item">
            <a data-bs-toggle="collapse" href="#sidebarLayouts">
                <i class="fas fa-th-list"></i>
                <p>Selling</p>
                <span class="caret"></span>
            </a>
            <div class="collapse" id="sidebarLayouts">
                <ul class="nav nav-collapse">
                    <li>
                        <a href="/invoice">
                            <span class="sub-item">Order</span>
                        </a>
                    </li>
                    <li>
                        <a href="/invoice/report">
                            <span class="sub-item">Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="/invoice/list">
                            <span class="sub-item">TRANSACTION</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a data-bs-toggle="collapse" href="#forms">
                <i class="fas fa-pen-square"></i>
                <p>Report</p>
                <span class="caret"></span>
            </a>
            <div class="collapse" id="forms">
                <ul class="nav nav-collapse">
                    <li>
                        <a href="forms/forms.html">
                            <span class="sub-item">Order</span>
                        </a>
                    </li>
                    <li>
                        <a href="forms/forms.html">
                            <span class="sub-item">Profit</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="/item">
                <i class="fas fa-list-alt"></i>
                <p>Item</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/profile/index">
                <i class="fas fa-user"></i>
                <p>Account</p>
            </a>
        </li>
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
            <a href="route('logout')"
            onclick="event.preventDefault();
                        this.closest('form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                {{ __('Log Out') }}
            </a>
            </form>
        </li>
        <br><br>
        <li class="nav-item">
            <a>
                <p>Logged in as:</p>
            </a>
        </li>
        <li class="nav-item">
            <a>
                <p>{{ session('role_name', 'No role assigned') }}</p>
            </a>
        </li>
    </ul>
</div>