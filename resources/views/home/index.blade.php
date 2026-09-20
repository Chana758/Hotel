<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.css')
</head>
<body class="main-layout">

    {{-- Page loader --}}
    <div class="loader_bg">
        <div class="loader"><img src="{{ asset('images/loading.gif') }}" alt="Loading"></div>
    </div>

    <header>
        @include('home.header')
    </header>

    @include('home.slider')      {{-- Banner + quick booking --}}
    @include('home.about')       {{-- About us --}}
    @include('home.ourroom')     {{-- Rooms --}}
    @include('home.gallery')     {{-- Gallery --}}
    {{-- @include('home.blog') --}}
    @include('home.contact')     {{-- Contact form + map --}}
    @include('home.footer')

</body>
</html>