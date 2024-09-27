<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a href="{{ route('dashboard') }}">
                <img class="img-fluid for-light"
                    src="{{ asset('assets/images/logo.png') }}" alt="">
                <img class="img-fluid for-dark"
                    src="{{ asset('assets/images/logo-dark.png') }}" alt="">
            </a>
            <div class="back-btn">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="{{ route('dashboard') }}">
                <img class="img-fluid"
                    src="{{ asset('assets/images/logo-icon.png') }}" alt="">
            </a>
        </div>

        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="{{ route('dashboard') }}">
                            <img class="img-fluid" 
                                src="{{ asset('assets/images/logo-icon.png') }}" alt="">
                        </a>
                        <div class="mobile-back text-end">
                            <span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>

                    <li class="pin-title sidebar-main-title">
                        <div>
                            <h6></h6>
                        </div>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{Route::currentRouteName()=='dashboard' ? 'active' : '' }}" 
                            href="{{route('dashboard')}}">
                            <i data-feather="home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{Route::currentRouteName()=='bookings.index' ? 'active' : '' }}" 
                            href="{{route('bookings.index')}}">
                            <i data-feather="pocket"></i>
                            <span>Bookings</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" 
                            href="#">
                            <i data-feather="pocket"></i>
                            <span>Reservations</span>
                        </a>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav {{Route::currentRouteName()=='guests.index' ? 'active' : '' }}" href="{{route('guests.index')}}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-user') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
                            </svg><span>Guests</span></a>
                    </li>

                    @can('statistics')
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='loyalty' ? 'active' : '' }}" 
                            href="{{route('loyalty')}}">
                            <i data-feather="pie-chart"></i> 
                            <span>Customer Loyalty </span>
                        </a>
                    </li>
                    @endcan

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{Route::currentRouteName()=='rooms.index' ? 'active' : '' }}" 
                            href="{{route('rooms.index')}}">
                            <i data-feather="home"></i>
                            <span>Rooms</span></a>
                    </li>
 
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{Route::currentRouteName()=='roomtypes.index' ? 'active' : '' }}" 
                            href="{{route('roomtypes.index')}}">
                            <i data-feather="command"></i>
                            <span>Room Types</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{Route::currentRouteName()=='services.index' ? 'active' : '' }}" 
                            href="{{route('services.index')}}">
                            <i data-feather="wifi"></i>
                            <span>Services</span>
                        </a>
                    </li>

                    {{-- @can('statistics')
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='stats' ? 'active' : '' }}" 
                            href="{{route('stats')}}">
                            <i data-feather="pie-chart"></i> 
                            <span>Statistics </span>
                        </a>
                    </li> 
                    @endcan --}}

                    @can('employees')
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='employees.index' ? 'active' : '' }}" 
                            href="{{route('employees.index')}}">
                            <i data-feather="users"> </i>
                            <span>Employees</span>
                        </a>
                    </li>
                    @endcan

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='users.index' ? 'active' : '' }}" 
                            href="{{route('users.index')}}">
                            <i data-feather="users"></i>
                            <span>Users</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='payroll' ? 'active' : '' }}" 
                            href="{{route('payroll')}}">
                            <i data-feather="credit-card"></i>
                            <span>Payroll</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='activity' ? 'active' : '' }}" 
                            href="{{route('activity')}}">
                            <i data-feather="activity"></i>
                            <span>Activity</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='payments.index' ? 'active' : '' }}" 
                            href="{{route('payments.index')}}">
                            <i data-feather="credit-card"></i>
                            <span>Payments</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='account' ? 'active' : '' }}" 
                            href="{{route('account')}}">
                            <i data-feather="user"></i>
                            <span>Account</span>
                        </a>
                    </li>

                    @can('settings')
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" 
                            href="{{ route('settings') }}">
                            <i data-feather="settings"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>