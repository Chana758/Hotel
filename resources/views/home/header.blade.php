<div class="header">
    <div class="container">
        <div class="row">

            {{-- Logo (managed from Admin > Settings) --}}
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                <div class="full">
                    <div class="center-desk">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset(get_setting('logo', 'images/logo.png')) }}" alt="{{ config('app.name') }}" style="max-height:50px;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Navigation --}}
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                <nav class="navigation navbar navbar-expand-md navbar-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="mainNav">
                        <ul class="navbar-nav mr-auto">
                            @php
                                $links = [
                                    ['/',              'Home',       '/'],
                                    ['about',          'About',      'about'],
                                    ['our_rooms',      'Our Rooms',  'our_rooms'],
                                    ['hotel_gallery',  'Gallery',    'hotel_gallery'],
                                    ['contact',        'Contact Us', 'contact'],
                                ];
                            @endphp
                            @foreach($links as [$path, $label, $match])
                                <li class="nav-item {{ request()->is($match) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ url($path) }}">{{ $label }}</a>
                                </li>
                            @endforeach

                            @if (Route::has('login'))
                                @auth
                                    <li class="nav-item">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" style="margin:5px 0 0 10px;">Logout</button>
                                        </form>
                                    </li>
                                @else
                                    <li class="nav-item" style="padding-right:12px;">
                                        <a class="btn btn-success btn-sm" href="{{ route('login') }}" style="font-size:17px;padding:4px 15px 4px 15px;">Login</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item" style="padding-right:12px;">
                                            <a class="btn btn-primary btn-sm" href="{{ route('register') }}" style="font-size:17px;padding:4px 16px 4px 16px;">Register</a>
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