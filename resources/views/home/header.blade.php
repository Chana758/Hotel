<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                <div class="full">
                    <div class="center-desk">
                        <div class="logo">
                            {{-- ទាញយក Logo ពី Setting --}}
                            <a href="{{ url('/') }}">
                              <img src="{{ asset(get_setting('logo', 'images/logo.png')) }}" alt="#" style="max-height: 50px;" /></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                <nav class="navigation navbar navbar-expand-md navbar-dark ">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('about') }}">About</a>
                            </li>
                            <li class="nav-item {{ Request::is('our_rooms') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('our_rooms') }}">Our room</a>
                            </li>
                            <li class="nav-item {{ Request::is('hotel_gallery') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('hotel_gallery') }}">Gallery</a>
                            </li>
                            <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('contact') }}">Contact Us</a>
                            </li>

                            @if (Route::has('login'))
                                @auth
                                    {{-- ប្រើប៊ូតុង Logout ធម្មតាដើម្បីកុំឱ្យខូច Layout --}}
                                    <li class="nav-item">
                                        <form method="POST" action="{{ route('logout') }}" class="inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" style="margin-top: 5px; margin-left: 10px;">
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                @else
                                    <li class="nav-item" style="padding-right: 12px">
                                        <a class="btn btn-success btn-sm" href="{{ url('login') }}" style="font-size: 17px; padding-right: 15px; padding-left: 15px;">Login</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item" style="padding-right: 12px">
                                            <a class="btn btn-primary btn-sm" href="{{ url('register') }}" style="font-size: 17px; padding-right: 12px; padding-left: 12px;">Register</a>
                                        </li>
                                    @endif
                                @endauth
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>