<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title') | ZBT Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/admin.css') }}">
</head>
<body class="admin-body">
@php
    $adminModule = request()->route('module');
    $navActive = fn (string $module): bool => request()->routeIs('admin.module.*') && $adminModule === $module;
@endphp
<div class="admin-backdrop" data-admin-backdrop aria-hidden="true"></div>
<div class="admin-layout">
    <aside class="sidebar" id="admin-sidebar">
        <div class="brand">
            <img src="{{ site_logo_url(\App\Models\Setting::pluck('value', 'key')->all()) }}" alt="ZBT">
            <div>
                <strong>Zaman Build Tech</strong>
                <small>Website Admin</small>
            </div>
        </div>
        <div class="nav">
            <a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.dashboard')])>Dashboard</a>

            <div class="nav-group">Home Management</div>
            <a href="{{ route('admin.module.index', 'hero') }}" @class(['active' => $navActive('hero')])>Hero / Video Slider</a>
            <a href="{{ route('admin.module.index', 'home-sections') }}" @class(['active' => $navActive('home-sections')])>Who We Are</a>
            <a href="{{ route('admin.module.index', 'achievements') }}" @class(['active' => $navActive('achievements')])>Statistics</a>
            <a href="{{ route('admin.module.index', 'why-choose') }}" @class(['active' => $navActive('why-choose')])>Why Choose Us</a>
            <a href="{{ route('admin.module.index', 'process') }}" @class(['active' => $navActive('process')])>Construction Process</a>
            <a href="{{ route('admin.module.index', 'consultation') }}" @class(['active' => $navActive('consultation')])>Consultation CTA</a>

            <div class="nav-group">Services & Projects</div>
            <a href="{{ route('admin.module.index', 'services') }}" @class(['active' => $navActive('services')])>Services</a>
            <a href="{{ route('admin.module.index', 'projects') }}" @class(['active' => $navActive('projects')])>Projects</a>
            <a href="{{ route('admin.module.index', 'properties') }}" @class(['active' => $navActive('properties')])>Properties</a>

            <div class="nav-group">Media</div>
            <a href="{{ route('admin.module.index', 'gallery') }}" @class(['active' => $navActive('gallery')])>Gallery</a>
            <a href="{{ route('admin.module.index', 'before-after') }}" @class(['active' => $navActive('before-after')])>Before & After</a>

            <div class="nav-group">Content</div>
            <a href="{{ route('admin.module.index', 'testimonials') }}" @class(['active' => $navActive('testimonials')])>Testimonials</a>
            <a href="{{ route('admin.module.index', 'team') }}" @class(['active' => $navActive('team')])>Team & Leadership</a>
            <a href="{{ route('admin.module.index', 'partners') }}" @class(['active' => $navActive('partners')])>Partners & Certifications</a>
            <a href="{{ route('admin.module.index', 'news') }}" @class(['active' => $navActive('news')])>News / Insights</a>
            <a href="{{ route('admin.module.index', 'faqs') }}" @class(['active' => $navActive('faqs')])>FAQs</a>

            <div class="nav-group">Leads</div>
            <a href="{{ route('admin.inquiries') }}" @class(['active' => request()->routeIs('admin.inquiries*') && request('type') !== 'Property Visit'])>Contact Inquiries</a>
            <a href="{{ route('admin.inquiries', ['type' => 'Property Visit']) }}" @class(['active' => request('type') === 'Property Visit'])>Property Visits</a>

            <div class="nav-group">Website</div>
            <a href="{{ route('admin.module.index', 'social') }}" @class(['active' => $navActive('social')])>Social Media</a>
            <a href="{{ route('admin.settings') }}" @class(['active' => request()->routeIs('admin.settings*')])>Contact & Settings</a>

            <div class="nav-group">Account</div>
            <a href="{{ route('home') }}" target="_blank" rel="noopener">Open Website ↗</a>
            <form method="post" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="nav-logout">Logout</button>
            </form>
        </div>
        <div class="side-foot">Laravel CMS — content and uploads are stored in MySQL and <code>storage/app/public</code>.</div>
    </aside>
    <div class="admin-main-wrap">
        <header class="admin-mobile-bar">
            <button type="button" class="btn btn-light btn-sm" data-admin-menu-toggle aria-controls="admin-sidebar" aria-expanded="false">☰ Menu</button>
            <strong>ZBT Admin</strong>
        </header>
        <main class="main">
            @if(session('success'))
                <div class="notice show">{{ session('success') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
<script src="{{ asset('assets/admin.js') }}"></script>
</body>
</html>
