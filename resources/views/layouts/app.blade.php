<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="{{ $settings['meta_description'] ?? 'Zaman Build Tech & Real Estate — construction, renovation and property solutions in Peshawar.' }}">
    <title>@yield('title', 'Zaman Build Tech & Real Estate')</title>
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
    @if(! empty($settings['favicon']))
        <link rel="icon" href="{{ cms_media($settings['favicon']) }}">
    @endif
    @stack('head')
</head>
<body @yield('body_attrs')>
@include('partials.site-header')
<main>@yield('content')</main>
@include('partials.site-footer')
</body>
</html>
