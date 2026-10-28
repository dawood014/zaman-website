<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Zaman Build Tech & Real Estate — construction, renovation and property solutions in Peshawar.">
    <title>@yield('title', 'Zaman Build Tech & Real Estate')</title>
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
    @stack('head')
</head>
<body>
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
            <img class="logo" src="{{ asset('assets/logo.png') }}" alt="Zaman Build Tech & Real Estate" onerror="this.style.display='none'">
        </a>
        <button class="menu" aria-label="Open menu">☰</button>
        <ul class="navlinks">
            <li><a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Home</a></li>
            <li><a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>About</a></li>
            <li><a href="{{ route('services') }}" @class(['active' => request()->routeIs('services*')])>Services</a></li>
            <li><a href="{{ route('projects') }}" @class(['active' => request()->routeIs('projects*')])>Projects</a></li>
            <li><a href="{{ route('properties') }}" @class(['active' => request()->routeIs('properties*')])>Properties</a></li>
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
<main>@yield('content')</main>
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <img class="footer-logo" src="{{ asset('assets/logo.png') }}" alt="Zaman Build Tech & Real Estate" onerror="this.style.display='none'">
                <p>{{ $settings['company'] ?? 'Zaman Build Tech & Real Estate' }} provides construction, renovation, ready-made houses and residential plots with cash and installment options in Peshawar.</p>
                <div class="socials">
                    @forelse(($social ?? collect()) as $link)
                        <a href="{{ $link->value('url', '#') }}" target="_blank" rel="noopener" title="{{ $link->value('platform', $link->title) }}">{{ $link->value('icon', $link->value('platform', 'Link')) }}</a>
                    @empty
                        <a href="#">f</a><a href="#">in</a><a href="#">▶</a><a href="#">◎</a>
                    @endforelse
                </div>
            </div>
            <div>
                <h4>Company</h4>
                <ul>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('team') }}">Our Team</a></li>
                    <li><a href="{{ route('achievements') }}">Achievements</a></li>
                    <li><a href="{{ route('news') }}">News & Insights</a></li>
                </ul>
            </div>
            <div>
                <h4>Explore</h4>
                <ul>
                    <li><a href="{{ route('services') }}">Services</a></li>
                    <li><a href="{{ route('projects') }}">Projects</a></li>
                    <li><a href="{{ route('properties') }}">Properties</a></li>
                    <li><a href="{{ route('gallery') }}">Gallery</a></li>
                </ul>
            </div>
            <div>
                <h4>Contact</h4>
                <ul>
                    <li data-address>{{ $settings['address'] ?? 'Warsak Road, Peshawar, Pakistan' }}</li>
                    <li><a data-phone href="tel:{{ preg_replace('/\s+/', '', $settings['phone'] ?? '') }}">{{ $settings['phone'] ?? '+92 300 0000000' }}</a></li>
                    <li><a data-email href="mailto:{{ $settings['email'] ?? 'info@zamanbuildtech.com' }}">{{ $settings['email'] ?? 'info@zamanbuildtech.com' }}</a></li>
                    <li><a href="{{ route('admin.login') }}">Admin Login</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© <span data-year></span> {{ $settings['company'] ?? 'Zaman Build Tech & Real Estate' }}. All rights reserved.</span>
            <span>Build • Renovate • Invest</span>
        </div>
    </div>
</footer>
<script>
    window.ZBT_SETTINGS = {!! json_encode([
        'address' => $settings['address'] ?? 'Warsak Road, Peshawar, Pakistan',
        'email' => $settings['email'] ?? 'info@zamanbuildtech.com',
        'phone' => $settings['phone'] ?? '+92 300 0000000',
        'whatsapp' => $settings['whatsapp'] ?? ($settings['phone'] ?? '+92 300 0000000'),
    ]) !!};
</script>
<script src="https://unpkg.com/lucide@0.468.0/dist/umd/lucide.min.js"></script>
<script src="{{ asset('assets/site.js') }}"></script>
@stack('scripts')
</body>
</html>
