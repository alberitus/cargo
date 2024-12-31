<div class="sidebar-content">
    <ul class="nav nav-secondary">
        <li class="nav-item {{ Request::is('/') || Request::is('index*') ? 'active' : '' }}">
            <a href="{{ route('index') }}">
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
        <li class="nav-item {{ Request::is('company*') || Request::is('job*') ? 'active submenu' : '' }}">
            <a data-bs-toggle="collapse" href="#base" class="{{ Request::is('company*') || Request::is('job*') ? '' : 'collapsed' }}">
                <i class="fas fa-building"></i>
                <p>Company</p>
                <span class="caret"></span>
            </a>
            <div class="collapse {{ Request::is('company*') || Request::is('job*') ? 'show' : '' }}" id="base">
                <ul class="nav nav-collapse">
                    <li class="{{ Request::is('company*') ? 'active' : '' }}">
                        <a href="{{ route('company.index') }}">
                            <span class="sub-item">Company List</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('job*') ? 'active' : '' }}">
                        <a href="{{ route('job.index') }}">
                            <span class="sub-item">Job List</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>        
        @endif
        @if(Auth::user()->role == 2)
        <li class="nav-item {{ Request::routeIs('item.index') ? 'active' : '' }}">
            <a href="{{ route('item.index') }}">
                <i class="fas fa-gift"></i>
                <p>Item</p>
            </a>
        </li>
        @endif
        @if(Auth::user()->role == 2)
        <li class="nav-item {{ Request::routeIs('consigne.index') ? 'active' : '' }}">
            <a href="{{ route('consigne.index') }}">
                <i class="fas fa-user"></i>
                <p>Consigne</p>
            </a>
        </li>
        @endif
        @if(Auth::user()->role == 2)
        <li class="nav-item {{ Request::routeIs('transaction.index') ? 'active' : '' }}">
            <a href="{{ route('transaction.index') }}">
                <i class="fas fa-dollar-sign"></i>
                <p>Transaction</p>
            </a>
        </li>
        @endif
        @if(Auth::user()->role == 2)
        <li class="nav-item {{ Request::routeIs('invoice*') ? 'active' : '' }}">
            <a href="{{ route('invoice.index') }}">
                <i class="fas fa-dollar-sign"></i>
                <p>Invoice</p>
            </a>
        </li>
        @endif
        @if(Auth::user()->role == 2)
        <li class="nav-item {{ Request::routeIs('faktur*') ? 'active' : '' }}">
            <a href="{{ route('faktur.index') }}">
                <i class="fas fa-dollar-sign"></i>
                <p>Faktur</p>
            </a>
        </li>
        @endif
        @if(Auth::user()->role == 2) <!-- Role 2 is Admin -->
        <li class="nav-item {{ Request::is('report*') ? 'active submenu' : '' }}">
        {{-- <li class="nav-item {{ Request::routeIs('report.company') ? 'active' : '' }}"> --}}
            <a data-bs-toggle="collapse" href="#reportnav" class="{{ Request::is('report*') ? '' : 'collapsed' }}">
            {{-- <a data-bs-toggle="collapse" href="#reportnav" class="{{ Request::is('report/company*') ? '' : 'collapsed' }}"> --}}
                <i class="fas fa-file"></i>
                <p>Report</p>
                <span class="caret"></span>
            </a>
            <div class="collapse {{ Request::is('report/company*') ? 'show' : '' }}" id="reportnav">
                <ul class="nav nav-collapse">
                    <li class="{{ Request::is('report/company*') ? 'active' : '' }}">
                        <a href="{{ route('report.company') }}">
                            <span class="sub-item">Company</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('report/payment*') ? 'active' : '' }}">
                        <a href="{{ route('report.payment') }}">
                            <span class="sub-item">Payment</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('report/outstanding*') ? 'active' : '' }}">
                        <a href="{{ route('report.outstanding') }}">
                            <span class="sub-item">Outstanding</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('report/detailinv') ? 'active' : '' }}">
                        <a href="{{ route('report.detailinv') }}">
                            <span class="sub-item">Detail Invoice</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('report/detailinvcus*') ? 'active' : '' }}">
                        <a href="{{ route('report.detailinvcus') }}">
                            <span class="sub-item">Detail Invoice Customer</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('report/tax*') ? 'active' : '' }}">
                        <a href="{{ route('report.tax') }}">
                            <span class="sub-item">Tax</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('report/item*') ? 'active' : '' }}">
                        <a href="{{ route('report.item') }}">
                            <span class="sub-item">Invoice</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>              
        @endif
        @if(Auth::user()->role == 2)
        <li class="nav-item {{ Request::routeIs('profile.index') ? 'active' : '' }}">
            <a href="{{ route('profile.index') }}">
                <i class="fas fa-user-secret"></i>
                <p>Account</p>
            </a>
        </li>
        @endif
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
            <a href="route('logout')"
            onclick="event.preventDefault();
                        this.closest('form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <p>{{ __('Log Out') }}</p>
                
            </a>
            </form>
        </li>
        <br>
        <li class="nav-section">
            <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Logged in as:</h4>
            <h4 class="text-section">{{ session('role_name', 'No role assigned') }}</h4>
        </li>
    </ul>
</div>
