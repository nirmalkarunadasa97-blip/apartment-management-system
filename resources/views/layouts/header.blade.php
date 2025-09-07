<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                    <div class="list-group-item list-group-item-action border-0">
                        <div>
                            <p>{{ auth()->user()->email }}</p>
                            <p>{{ Str::limit(auth()->user()->name, 15) }}</p>
                        </div>
                    </div>

                    <a class="list-group-item list-group-item-action border-0" href="{{ route('logout') }}"
                        role="button"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        style="background-color:#ff0000; color:#ffffff">
                        <i class="icofont-logout fs-6 me-3"></i>Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>

        </ul>
    </ul>

</nav>
