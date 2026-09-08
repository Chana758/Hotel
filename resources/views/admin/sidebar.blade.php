<style>
    /* === 1. រៀបចំ Sidebar ទាំងមូល === */
    #sidebar {
        background: #111111; 
        min-width: 280px;
        max-width: 280px;
        color: #adb5bd;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        min-height: 100vh;
        box-shadow: 10px 0 30px rgba(0,0,0,0.5);
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }

    /* Sidebar Header & Profile */
    #sidebar .sidebar-header {
        padding: 40px 25px;
        background: #151515;
        border-bottom: 1px solid rgba(255,255,255,0.03);
        text-align: center;
    }

    .avatar-container {
        position: relative;
        display: inline-block;
        margin-bottom: 15px;
    }

    .avatar {
        width: 70px;
        height: 70px;
        border-radius: 100%; 
        overflow: hidden;
        border: 2px solid #db6574;
        transition: 0.3s;
        box-shadow: 0 8px 15px rgba(219, 101, 116, 0.2);
    }

    .avatar img {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        object-fit: cover;
    }

    .avatar-container::after {
        content: "";
        width: 12px;
        height: 12px;
        background: #2ecc71;
        border: 2px solid #151515;
        position: absolute;
        bottom: 5px;
        right: -2px;
        border-radius: 50%;
    }

    .title h1 {
        color: #ffffff;
        font-size: 1.1rem;
        font-weight: 700;
        margin: 0;
        letter-spacing: 0.5px;
    }

    .title p {
        font-size: 0.75rem;
        color: #db6574;
        margin-top: 3px;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 1px;
    }

    /* រៀបចំស្តាយអក្សរ MAIN MENU ឱ្យមានស្រមោល និងរាងបញ្ឈិត */
    #sidebar .heading {
        font-size: 0.75rem;
        letter-spacing: 4px;
        font-weight: 900;
        color: #db6574;
        padding: 35px 25px 15px;
        text-transform: uppercase;
        display: block;
        transform: skewX(-10deg); 
        text-shadow: 2px 2px 0px #952936, 4px 4px 8px rgba(42, 38, 38, 0.8);
        background: linear-gradient(to right, #db6574, #ff7e8d);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        transition: 0.4s ease;
    }

    #sidebar .heading:hover {
        filter: brightness(1.2);
        transform: skewX(-12deg) scale(1.05);
    }

    /* === 2. រៀបចំ Menu Links === */
    #sidebar ul.menu-list {
        padding: 0 15px;
    }

    #sidebar ul li {
        margin-bottom: 8px;
        list-style: none;
    }

    #sidebar ul li a {
        padding: 12px 20px;
        color: #979797;
        display: flex;
        align-items: center;
        text-decoration: none;
        font-size: 0.95rem;
        border-radius: 12px; 
        transition: all 0.3s ease;
    }

    #sidebar ul li a i {
        margin-right: 15px;
        width: 25px;
        text-align: center;
        color: #db6574;
        font-size: 1.1rem;
    }

    #sidebar ul li a:hover {
        background: rgba(219, 101, 116, 0.08);
        color: #ffffff;
        transform: translateX(5px);
    }

    /* Active State */
    #sidebar ul li.active > a {
        background: linear-gradient(45deg, #db6574, #b24552);
        color: #ffffff !important;
        box-shadow: 0 4px 15px rgba(219, 101, 116, 0.4);
    }

    #sidebar ul li.active > a i {
        color: #ffffff;
    }

    /* === 3. Submenu Style === */
    .submenu {
        background: rgba(255,255,255,0.02);
        margin: 5px 10px;
        border-radius: 10px;
        padding: 5px 0;
    }

    .submenu li a {
        padding-left: 50px !important;
        font-size: 0.85rem !important;
    }

    .submenu li.active-sub a {
        color: #db6574 !important;
        background: transparent !important;
        font-weight: bold;
    }

    .arrow-icon {
        margin-left: auto;
        font-size: 0.8rem;
        transition: transform 0.3s;
    }

    a[aria-expanded="true"] .arrow-icon {
        transform: rotate(180deg);
    }
</style>

<div class="d-flex align-items-stretch">
    <nav id="sidebar">
        <!-- Sidebar Header (ព័ត៌មានពី Setting) -->
        <div class="sidebar-header">
            <div class="avatar-container">
                <a href="{{ url('/') }}">
                    <div class="avatar">
                        {{-- ទាញរូបភាព Admin ពី Setting --}}
                        <img src="{{ asset(get_setting('admin_image', 'images/channa.jpg')) }}" alt="Admin Avatar">
                    </div>
                </a>
            </div>
            <div class="title">
                <a href="{{ url('/') }}" class="text-decoration-none">
                    {{-- ទាញឈ្មោះ និងតំណែងពី Setting --}}
                    <h1>{{ get_setting('admin_name', 'Sam Channa') }}</h1>
                    <p>{{ get_setting('admin_title', 'Web Developer') }}</p>
                </a>
            </div>
        </div>
        
        <!-- Main Menu Heading (ព័ត៌មានពី Setting) -->
        <span class="heading">
            <i class="fa fa-terminal" style="font-size: 18px; margin-right: 5px; -webkit-text-fill-color: #db6574;"></i> 
            {{ get_setting('sidebar_heading', 'Main Menu') }}
        </span>
        
        <ul class="list-unstyled menu-list">
            <!-- Home -->
            <li class="{{ Request::is('/') || Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-th-large"></i> 
                    <span>Home</span>
                </a>
            </li>

            <!-- Hotel Rooms -->
            <li class="{{ Request::is('create_room') || Request::is('view_room') ? 'active' : '' }}">
                <a href="#roomDropdown" data-bs-toggle="collapse" aria-expanded="{{ Request::is('create_room') || Request::is('view_room') ? 'true' : 'false' }}" class="dropdown-toggle-custom">
                    <i class="fa fa-bed"></i> 
                    <span>Hotel Rooms</span>
                    <i class="fa fa-angle-down arrow-icon"></i>
                </a>
                <ul id="roomDropdown" class="collapse list-unstyled submenu {{ Request::is('create_room') || Request::is('view_room') ? 'show' : '' }}">
                    <li class="{{ Request::is('create_room') ? 'active-sub' : '' }}">
                        <a href="{{ url('create_room') }}"><i class="fa fa-plus"></i> Add Rooms</a>
                    </li>
                    <li class="{{ Request::is('view_room') ? 'active-sub' : '' }}">
                        <a href="{{ url('view_room') }}"><i class="fa fa-list"></i> View Rooms</a>
                    </li>
                </ul>
            </li>

            <!-- Bookings -->
            <li class="{{ Request::is('view_bookings') ? 'active' : '' }}">
                <a href="{{ url('view_bookings') }}">
                    <i class="fa fa-calendar-check-o"></i> 
                    <span>Bookings</span>
                </a>
            </li>

            <!-- Gallery -->
            <li class="{{ Request::is('view_gallery') ? 'active' : '' }}">
                <a href="{{ url('view_gallery') }}">
                    <i class="fa fa-image"></i> 
                    <span>Gallery</span>
                </a>
            </li>
            <li class="{{ Request::is('all_messages') ? 'active' : '' }}">
            <a href="{{ url('all_messages') }}">
                <i class="fa fa-envelope-o"></i> 
                <span>Messages</span>
                {{-- បើចង់ដាក់លេខសម្គាល់សារថ្មី មេអាចប្រើ Badge នេះ (Optional) --}}
                @php $msgCount = App\Models\Contact::count(); @endphp
                @if($msgCount > 0)
                    <span class="badge rounded-pill bg-danger ml-auto" style="font-size: 10px; background: #db6574 !important;">{{ $msgCount }}</span>
                @endif
            </a

            <!-- Settings -->
            <li class="{{ Request::is('setting') ? 'active' : '' }}">
                <a href="{{ url('setting') }}">
                    <i class="fa fa-cog"></i> 
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    </nav>
