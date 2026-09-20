<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<title>{{ config('app.name') }} | Admin</title>

{{-- Vendor styles --}}
<link rel="stylesheet" href="{{ asset('Admin/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('Admin/vendor/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('Admin/css/font.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
<link rel="stylesheet" href="{{ asset('Admin/css/style.default.css') }}" id="theme-stylesheet">
<link rel="stylesheet" href="{{ asset('Admin/css/custom.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

{{-- Favicon --}}
<link rel="shortcut icon" href="{{ asset('Admin/img/favicon.ico') }}">

{{-- Project theme (must stay last so it overrides the vendor styles) --}}
<link rel="stylesheet" href="{{ asset('Admin/css/hotel.css') }}">