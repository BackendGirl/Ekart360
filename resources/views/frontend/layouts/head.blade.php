@php
 $current_theme = DB::table('themes')->where('current_theme',1)->first();
@endphp

@yield('meta')

<!-- <meta charset="utf-8"> -->
<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
<meta name="theme-color" content="#000000">

<title>@yield('title','Fastkart')</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="Amit Pratap Singh">
<meta name="description" content="{!! str_limit(strip_tags($settings->meta_description), 160, ' ...') !!}">
<meta name="keywords" content="{!! strip_tags($settings->meta_keywords) !!}">
<link rel="shortcut icon" href="{{ asset('uploads/setting/'.$settings->favicon_path) }}" type="image/x-icon">
<title>@yield('title','On-demand last-mile delivery')</title>

<!-- Google font -->
<link rel="preconnect" href="https://fonts.gstatic.com/">
<link href="https://fonts.googleapis.com/css2?family=Russo+One&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Pacifico&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&amp;display=swap"
    rel="stylesheet">
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap">

<!-- bootstrap css -->
<link id="rtl-link" rel="stylesheet" type="text/css"
    href="{{URL::to('public/frontend/bakery/assets/css/vendors/bootstrap.css')}}">

<!-- wow css -->
<link rel="stylesheet" href="{{URL::to('public/frontend/bakery/assets/css/animate.min.css')}}" />

<!-- font-awesome css -->
<link rel="stylesheet" type="text/css" href="{{URL::to('public/frontend/bakery/assets/css/vendors/font-awesome.css')}}">

<!-- feather icon css -->
<link rel="stylesheet" type="text/css" href="{{URL::to('public/frontend/bakery/assets/css/vendors/feather-icon.css')}}">

<!-- slick css -->
<link rel="stylesheet" type="text/css" href="{{URL::to('public/frontend/bakery/assets/css/vendors/slick/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::to('public/frontend/bakery/assets/css/vendors/slick/slick-theme.css')}}">

<!-- Iconly css -->
<link rel="stylesheet" type="text/css" href="{{URL::to('public/frontend/bakery/assets/css/bulk-style.css')}}">

<!-- Template css -->
<link id="color-link" rel="stylesheet" type="text/css" href="{{URL::to('public/frontend/bakery/assets/css/style.css')}}">


<!-- google tag manager -->
<!-- qwertyuiop -->


<style>
   :root {
    --theme-color: {{$current_theme->theme_color ?? '#d99f46'}} !important;
    --theme-color-rgb: 13, 164, 135;
    --theme-color1: {{$current_theme->theme_color1 ?? '#d99f46'}} !important;
    --theme-color1-rgb: 14, 148, 122;
    --theme-color2: linear-gradient(90.56deg, var(--theme-color1) 8.46%, var(--theme-color) 62.97%)
}

.add_to_wishlist{color: var(--theme-color);}

.mega_menu_dropdown div div a{white-space: normal;}

header .navbar.navbar-expand-xl .navbar-nav .nav-link-manual::before{all:unset;}

.location_icon{margin-right:10px;}

.cartli{display:block !important;}
</style>
