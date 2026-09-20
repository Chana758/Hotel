@php
    $roomMenuOpen = request()->is('create_room', 'view_room');
    $messageCount = \App\Models\Contact::count();
@endphp

{{-- Layout wrapper: closed at the end of admin/footer.blade.php --}}
<div class="d-flex align-items-stretch">
    <nav id="sidebar">

        {{-- Profile (values come from the Settings page) --}}
        <div class="sidebar-header">
            <div class="avatar-container">
                <a href="{{ route('dashboard') }}">
                    <div class="avatar">
                        <img src="{{ asset(get_setting('admin_image', 'images/channa.jpg')) }}" alt="Admin avatar">
                    </div>
                </a>
            </div>
            <div class="title">
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <h1>{{ get_setting('admin_name', 'Admin') }}</h1>
                    <p>{{ get_setting('admin_title', 'Manager') }}</p>
                </a>
            </div>
        </div>

        <span class="heading">
            <i class="fa fa-terminal" style="font-size:18px;margin-right:5px;-webkit-text-fill-color:#db6574;"></i>
            {{ get_setting('sidebar_heading', 'Main Menu') }}
        </span>

        <ul class="list-unstyled menu-list">

            {{-- Home --}}
            <li class="{{ request()->is('dashboard', 'admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"><i class="fa fa-th-large"></i><span>Home</span></a>
            </li>

            {{-- Hotel rooms (collapsible) --}}
            <li class="{{ $roomMenuOpen ? 'active' : '' }}">
                <a href="#roomDropdown" data-bs-toggle="collapse" aria-expanded="{{ $roomMenuOpen ? 'true' : 'false' }}">
                    <i class="fa fa-bed"></i><span>Hotel Rooms</span>
                    <i class="fa fa-angle-down arrow-icon"></i>
                </a>
                <ul id="roomDropdown" class="collapse list-unstyled submenu {{ $roomMenuOpen ? 'show' : '' }}">
                    <li class="{{ request()->is('create_room') ? 'active-sub' : '' }}">
                        <a href="{{ url('create_room') }}"><i class="fa fa-plus"></i> Add Rooms</a>
                    </li>
                    <li class="{{ request()->is('view_room') ? 'active-sub' : '' }}">
                        <a href="{{ url('view_room') }}"><i class="fa fa-list"></i> View Rooms</a>
                    </li>
                </ul>
            </li>

            {{-- Bookings --}}
            <li class="{{ request()->is('view_bookings', 'add_booking', 'edit_booking/*') ? 'active' : '' }}">
                <a href="{{ url('view_bookings') }}"><i class="fa fa-calendar-check-o"></i><span>Bookings</span></a>
            </li>

            {{-- Gallery --}}
            <li class="{{ request()->is('view_gallery') ? 'active' : '' }}">
                <a href="{{ url('view_gallery') }}"><i class="fa fa-image"></i><span>Gallery</span></a>
            </li>

            {{-- Messages (with counter) --}}
            <li class="{{ request()->is('all_messages') ? 'active' : '' }}">
                <a href="{{ url('all_messages') }}">
                    <i class="fa fa-envelope-o"></i><span>Messages</span>
                    @if($messageCount > 0)
                        <span class="badge rounded-pill ml-auto" style="font-size:10px;background:#db6574;color:#fff;">{{ $messageCount }}</span>
                    @endif
                </a>
            </li>

            {{-- Settings --}}
            <li class="{{ request()->is('setting') ? 'active' : '' }}">
                <a href="{{ url('setting') }}"><i class="fa fa-cog"></i><span>Settings</span></a>
            </li>
        </ul>
    </nav>