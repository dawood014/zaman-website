@php($settings = $settings ?? [])
<div class="topbar">
    <div class="container">
        <span>Construction • Renovation • Ready Houses • Plots</span>
        <span>{{ $settings['address'] ?? 'Warsak Road, Peshawar' }}</span>
    </div>
</div>
<header class="header">
    <div class="container nav">
        <a href="{{ route('home') }}">
            <img class="logo" src="{{ site_logo_url($settings ?? []) }}" alt="{{ $settings['company'] ?? 'Zaman Build Tech & Real Estate' }}" onerror="this.style.display='none'">
        </a>
        <button class="menu" aria-label="Open menu">☰</button>
        <ul class="navlinks">
            <li><a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Home</a></li>
            <li><a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>About</a></li>
            <li><a href="{{ route('services.index') }}" @class(['active' => request()->routeIs('services*')])>Services</a></li>
            <li><a href="{{ route('projects.index') }}" @class(['active' => request()->routeIs('projects*')])>Projects</a></li>
            <li><a href="{{ route('properties.index') }}" @class(['active' => request()->routeIs('properties*')])>Properties</a></li>
            <li><a href="{{ route('contact') }}" @class(['active' => request()->routeIs('contact')])>Contact</a></li>
            <li><a class="quote" href="{{ route('contact') }}#consultation">Free Consultation</a></li>
        </ul>
    </div>
</header>
@if(session('success'))
    <div class="container" style="padding-top:18px">
        <div class="alert-success" style="max-width:100%;margin:0;padding:14px 18px;background:#e8fff1;border:1px solid #a8e0ba;border-radius:10px">{{ session('success') }}</div>
    </div>
@endif
