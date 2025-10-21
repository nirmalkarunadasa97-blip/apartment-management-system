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
                        <a href="{{ route('apartment_resident.index') }}"
                            class="nav-link {{ Request::routeIs('apartment_resident.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Apartment
                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('apply_apartment.index') }}"
                            class="nav-link {{ Request::routeIs('apply_apartment.*', 'application_extention.*') ? 'active' : '' }}">
                            <i class="	fab fa-atlassian"></i>
                            <p>
                                Apply Apartment
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
                                class="nav-link {{ Request::routeIs('maintenance.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Maintenance
                                </p>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        @php
                            $unreadCount = \App\Models\Chat::where('user_read', 1)
                                ->where('user_id', auth()->id())
                                ->count();
                        @endphp
                        <a href="{{ route('resident_chat.create') }}" id="chat-button"
                            class="nav-link {{ Request::routeIs('resident_chat.create') ? 'active' : '' }}"
                            onclick="markChatsAsRead(event)">
                            <i class="nav-icon fas fa-comments"></i>
                            <p>
                                Chat @if ($unreadCount > 0)
                                    <span class="badge badge-danger" id="unread-count">{{ $unreadCount }}</span>
                                @endif
                            </p>
                        </a>
                    </li>

                    <script>
                        function markChatsAsRead(event) {
                            event.preventDefault(); // Prevent default link behavior

                            const url = "{{ route('update_user_read_status') }}"; // Route for updating read status
                            const chatPage = "{{ route('resident_chat.create') }}"; // Chat page route

                            fetch(url, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({}),
                                })
                                .then(response => {
                                    if (response.ok) {
                                        return response.json();
                                    }
                                    throw new Error('Failed to update read status');
                                })
                                .then(() => {
                                    window.location.href = chatPage; // Redirect to chat page
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    // Redirect to chat page even if the fetch fails
                                    window.location.href = chatPage;
                                });
                        }
                    </script>

                    @php
                        $hasAppartmentApplication = \App\Models\ApartmentApplication::where('resident_id', auth()->id())
                            ->where('status', 2)
                            ->exists();
                    @endphp

                    @if ($hasAppartmentApplication)
                        <li class="nav-item">
                            <a href="{{ route('apartment_payment.index') }}"
                                class="nav-link {{ Request::routeIs('apartment_payment.*') ? 'active' : '' }}">
                                <i class="fab fa-amazon-pay"></i>
                                <p>
                                    Payment
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
