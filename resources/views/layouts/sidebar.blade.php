<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ URL::to('/admin/home') }}" class="brand-link">
        <img src="{{ asset('dist/img/NEMESIS.jpg') }}" alt="RestaurantQ Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">NEMESIS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ URL::to('/admin/home') }}" class="nav-link {{ Request::is('/admin/home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @if(Auth::check() && Auth::user()->role == 'super admin')
                <li class="nav-header">Gym Management</li>
                <li class="nav-item">
                    <a href="{{ URL::to('/member-package') }}" class="nav-link {{ Request::is('member-package') ? 'active' : '' }}">
                        <i class="fas fa-id-badge nav-icon"></i>
                        <p>
                            Member Packages
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('/trainer') }}" class="nav-link {{ Request::is('trainer') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-child"></i>
                        <p>
                            Trainers List
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('/supplement') }}" class="nav-link {{ Request::is('supplement') ? 'active' : '' }}">
                        <i class="fas fa-utensils nav-icon"></i>
                        <p>
                            Supplements
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('/program') }}" class="nav-link {{ Request::is('program') ? 'active' : '' }}">
                        <i class="fas fa-server nav-icon"></i>
                        <p>
                            Programs
                        </p>
                    </a>
                </li>
                @endif

                @if(Auth::check() && (Auth::user()->role == 'super admin' || Auth::user()->role == 'admin'))
                <li class="nav-item {{ Request::is('registration-admin') || Request::is('check-status') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('registration') || Request::is('check-status') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Transactions
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('/registration-admin') }}" class="nav-link {{ Request::is('registration-admin') ? 'active' : '' }}">
                                <i class="far fa-window-maximize nav-icon"></i>
                                <p>Registrations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('/check-status') }}" class="nav-link {{ Request::is('check-status') ? 'active' : '' }}">
                                <i class="far fa-calendar-check nav-icon"></i>
                                <p>Check Status</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                <a href="{{ URL::to('/contact-us') }}" class="nav-link {{ Request::is('contact-us') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-envelope"></i>
                    <p>
                        Contact
                    </p>
                </a>
            </li>
                @endif

                @if (auth()->user()->role == 'super admin')
                <li class="nav-header">Home Management</li>
                <li class="nav-item">
                    <a href="{{ URL::to('/carousel') }}" class="nav-link {{ Request::is('carousel') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-window-restore"></i>
                        <p>
                            Carousel
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('/configuration') }}" class="nav-link {{ Request::is('map') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-map-pin"></i>
                        <p>
                        Configurations
                        </p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->role == 'super admin')
                <li class="nav-header">User Management</li>
                <li class="nav-item">
                    <a href="{{ URL::to('/user') }}" class="nav-link {{ Request::is('user') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
