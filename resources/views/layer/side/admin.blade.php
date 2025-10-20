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
                        <a href="{{ route('apply_apartment_admin.index') }}"
                            class="nav-link {{ Request::routeIs('apply_apartment_admin.*') ? 'active' : '' }}">
                            <i class="	fab fa-atlassian"></i>
                            <p>
                                Apply Apartment
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin_maintenance.index') }}"
                            class="nav-link {{ Request::routeIs('admin_maintenance.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-wrench"></i>
                            <p>
                                Maintenance Request
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin-users.create') }}"
                            class="nav-link {{ Request::routeIs('admin-users.create') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>Register User</p>
                        </a>
                    </li>

                    <!-- NEW TAB 1: Residents -->
                    <li class="nav-item">
                        <a href="{{ route('residents.index') }}"
                            class="nav-link {{ Request::routeIs('residents.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Residents</p>
                        </a>
                    </li>

                    <!-- NEW TAB 2: Announcements -->
                    <li class="nav-item">
                        <a href="{{ route('announcements.index') }}"
                            class="nav-link {{ Request::routeIs('announcements.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-bullhorn"></i>
                            <p>Announcements</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('report.index') }}"
                            class="nav-link {{ Request::routeIs('report.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-atlas"></i>
                            <p>Report</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin_chat.index') }}"
                            class="nav-link {{ Request::routeIs('admin_chat.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-comments"></i>
                            <p>
                                Chat
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('apartment_payment.index') }}"
                            class="nav-link {{ Request::routeIs('apartment_payment.index') ? 'active' : '' }}">
                            <i class="fab fa-amazon-pay"></i>
                            <p>
                                Payment
                            </p>
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
