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
                        <a href="{{ route('resdash.index') }}"
                            class="nav-link {{ Request::routeIs('resdash.index') ? 'active' : '' }}">
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
                        <a href="{{ route('announcements.index') }}"
                            class="nav-link {{ Request::routeIs('announcements.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-bullhorn"></i>
                            <p>
                                Announcements
                            </p>
                        </a>
                    </li>

                    @php
                        $hasApartmentApplication = \App\Models\ApartmentApplication::where('resident_id', auth()->id())
                            ->where('status', 2)
                            ->exists();
                    @endphp

                    @if ($hasApartmentApplication)
                        <li class="nav-item">
                            <a href="{{ route('maintenance.index') }}"
                                class="nav-link {{ Request::routeIs('maintenance.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Maintenance
                                </p>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{ route('change_password.edit', ['change_password' => auth()->user()->id]) }}"
                            class="nav-link {{ Request::routeIs('change_password.*') ? 'active' : '' }}">
                            <i class="fab fa-asymmetrik"></i>
                            <p>
                                Change Password
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('profile_update.edit', ['profile_update' => auth()->user()->id]) }}"
                            class="nav-link {{ Request::routeIs('profile_update.*') ? 'active' : '' }}">
                            <i class="fab fa-audible"></i>
                            <p>
                                Update Profile
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
