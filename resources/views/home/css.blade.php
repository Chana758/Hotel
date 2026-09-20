<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name') }}</title>
<meta name="description" content="Book your stay at {{ config('app.name') }}.">

{{-- Template styles (asset() keeps the paths working on nested routes) --}}
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}">
<link rel="icon" href="{{ asset('images/fevicon.png') }}" type="image/png">

{{-- Icons + lightbox --}}
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">