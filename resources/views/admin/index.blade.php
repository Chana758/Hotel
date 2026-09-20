<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    {{-- .page-content is closed by admin/footer.blade.php --}}
    <div class="page-content">
        @if(request()->is('dashboard', 'admin/dashboard', '/'))
            @include('admin.body')
        @else
            @yield('content')
        @endif

        @include('admin.footer')
</body>
</html>