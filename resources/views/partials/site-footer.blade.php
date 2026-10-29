@php($settings = $settings ?? [])
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <img class="footer-logo" src="{{ site_logo_url($settings) }}" alt="{{ $settings['company'] ?? 'Zaman Build Tech & Real Estate' }}" onerror="this.style.display='none'">
                <p>{{ $settings['footer_text'] ?? ($settings['company'] ?? 'Zaman Build Tech & Real Estate').' provides construction, renovation, ready-made houses and residential plots with cash and installment options in Peshawar.' }}</p>
                <div class="socials">
                    @include('partials.social-links', ['social' => $social ?? collect()])
                </div>
            </div>
            <div>
                <h4>Company</h4>
                <ul>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('team') }}">Our Team</a></li>
                    <li><a href="{{ route('achievements') }}">Achievements</a></li>
                    <li><a href="{{ route('news.index') }}">News & Insights</a></li>
                </ul>
            </div>
            <div>
                <h4>Explore</h4>
                <ul>
                    <li><a href="{{ route('services.index') }}">Services</a></li>
                    <li><a href="{{ route('projects.index') }}">Projects</a></li>
                    <li><a href="{{ route('properties.index') }}">Properties</a></li>
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
            <span>© <span data-year></span> {{ $settings['copyright'] ?? ($settings['company'] ?? 'Zaman Build Tech & Real Estate') }}. All rights reserved.</span>
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
        'siteUrl' => url('/'),
    ]) !!};
</script>
<script src="https://unpkg.com/lucide@0.468.0/dist/umd/lucide.min.js"></script>
<script src="{{ asset('assets/site.js') }}"></script>
@stack('scripts')
