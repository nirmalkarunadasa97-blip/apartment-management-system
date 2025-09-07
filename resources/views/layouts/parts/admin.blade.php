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
                        <a href="{{ route('admindashboard.index') }}"
                            class="nav-link {{ Request::routeIs('admindashboard.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
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
