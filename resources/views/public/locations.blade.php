@extends('layouts.public')
@section('title', 'Locations | Zaman Build Tech & Real Estate')
@section('content')
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs"><a href="{{ route('home') }}">Home</a><span>›</span><span>Locations</span></div>
        <h1>Locations</h1>
        <p class="lead" style="color:#ddd;margin-top:15px">Our operating area and featured project location.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="two-col">
            <div>
                <div class="eyebrow">Office Area</div>
                <h2 class="title-lg">{{ $settings['address'] ?? 'Warsak Road, Peshawar' }}</h2>
                <p class="lead">Company operations are based on Warsak Road with project and property activity in surrounding Peshawar areas.</p>
                <a class="btn btn-orange" href="{{ route('contact') }}">Contact Us</a>
            </div>
            <div class="map-wrap">
                <iframe loading="lazy" title="Map" src="https://www.google.com/maps?q={{ urlencode($settings['address'] ?? 'Warsak Road Peshawar') }}&output=embed"></iframe>
            </div>
        </div>
    </div>
</section>
@endsection
