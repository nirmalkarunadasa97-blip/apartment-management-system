@if (auth()->user()->is_active == 1)
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <h1 class="brand-link">
            <span class="brand-text font-weight">Apartment Management</span>
        </h1>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('addash.index') }}"
                            class="nav-link {{ Request::routeIs('addash.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('apartments.index') }}"
                            class="nav-link {{ Request::routeIs('apartments.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Apartment
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('apartment-applications.index') }}" class="nav-link {{ Request::routeIs('apartment-applications.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>Apartment Applications</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('maintenance.index') }}" class="nav-link {{ Request::routeIs('maintenance.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-wrench"></i>
                            <p>Maintenance</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('payments.index') }}" class="nav-link {{ Request::routeIs('payments.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-credit-card"></i>
                            <p>Payments</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('chats.index') }}" class="nav-link {{ Request::routeIs('chats.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-comments"></i>
                            <p>Chats</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('profile.index') }}" class="nav-link {{ Request::routeIs('profile.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Profile</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('change-password.index') }}" class="nav-link {{ Request::routeIs('change-password.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-key"></i>
                            <p>Change Password</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin-users.create') }}" class="nav-link {{ Request::routeIs('admin-users.create') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>Register User</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            style="background-color:#ff0000; color:#ffffff">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>



                </ul>
            </nav>
        </div>
    </aside>

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
@endif
