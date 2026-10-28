@extends('layouts.public')
@section('title', 'About | Zaman Build Tech & Real Estate')
@section('content')
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs"><a href="{{ route('home') }}">Home</a><span>›</span><span>About Us</span></div>
        <h1>About Us</h1>
        <p class="lead" style="color:#ddd;margin-top:15px">Construction, renovation and real estate support from Warsak Road, Peshawar.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="two-col">
            <div class="image-panel" style="background-image:url('https://mffagroup.com/wp-content/uploads/2024/01/WhatsApp-Image-2024-01-19-at-18.10.36_f2dde378.jpg')"></div>
            <div>
                <div class="eyebrow">Our Company</div>
                <h2 class="title-lg">Built around practical service and long-term client relationships.</h2>
                <p class="lead" style="margin-top:18px">Zaman Build Tech & Real Estate combines construction, renovation and property solutions so customers can work with one team from planning through ownership.</p>
                <ul class="checklist">
                    <li>Residential and commercial construction support</li>
                    <li>Renovation and remodeling services</li>
                    <li>Ready houses and residential plots</li>
                    <li>Zaman Villas project enquiries and site visits</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="section section-soft">
    <div class="container">
        <div class="section-head">
            <div><div class="eyebrow">Our Achievements</div><h2>Company strengths and milestones.</h2></div>
            <a class="btn btn-outline" href="{{ route('achievements') }}">View Full Profile</a>
        </div>
        <div class="stats-grid">
            @forelse($achievements as $x)
                <div class="stat-card"><strong>{{ $x->value('value', $x->title) }}</strong><span>{{ $x->value('label', $x->title) }}</span><small>{{ $x->value('description') }}</small></div>
            @empty
                <div class="stat-card"><strong>Local</strong><span>Peshawar Presence</span><small>Warsak Road based operations</small></div>
            @endforelse
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-head"><div><div class="eyebrow">Why Choose Us</div><h2>Simple reasons clients can work with confidence.</h2></div></div>
        <div class="cards">
            @foreach($whyChoose as $x)
                <div class="card"><h3>{{ $x->title }}</h3><p>{{ $x->value('description') }}</p></div>
            @endforeach
        </div>
    </div>
</section>
<section class="section section-dark">
    <div class="container">
        <div class="cards">
            <div class="card"><div class="eyebrow">Mission</div><h3>Deliver practical value</h3><p>To provide dependable construction, renovation and property services with clear communication and client-focused execution.</p></div>
            <div class="card"><div class="eyebrow">Vision</div><h3>Grow trusted local projects</h3><p>To build a strong Peshawar-based brand known for useful property solutions and quality delivery.</p></div>
            <div class="card"><div class="eyebrow">Values</div><h3>Quality • Clarity • Commitment</h3><p>Prioritize professional coordination, transparency, accountability and respect for client requirements.</p></div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-head">
            <div><div class="eyebrow">Our Team & Leadership</div><h2>People behind planning, execution and client support.</h2></div>
            <a class="btn btn-outline" href="{{ route('team') }}">Team Page</a>
        </div>
        <div class="team-grid">
            @foreach($team as $x)
                <div class="team-card">
                    @if($x->value('image'))<img src="{{ cms_media($x->value('image')) }}" alt="{{ $x->value('name', $x->title) }}">@endif
                    <div class="body"><h3>{{ $x->value('name', $x->title) }}</h3><small>{{ $x->value('role') }}</small></div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="section section-soft">
    <div class="container">
        <div class="section-head"><div><div class="eyebrow">Our Journey</div><h2>From construction services to an integrated real estate platform.</h2></div></div>
        <div class="timeline">
            <div class="timeline-item"><h3>Foundation</h3><p>Construction and renovation services established around practical client needs.</p></div>
            <div class="timeline-item"><h3>Real Estate Expansion</h3><p>Ready houses and plot opportunities added to provide broader property support.</p></div>
            <div class="timeline-item"><h3>Zaman Villas</h3><p>Residential project offering houses and plots with cash and installment options.</p></div>
            <div class="timeline-item"><h3>Digital Growth</h3><p>Website, property enquiry, sharing, WhatsApp and Laravel CMS management.</p></div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-head"><div><div class="eyebrow">Testimonials & Certifications</div><h2>Space ready for verified reviews, certificates and registrations.</h2></div></div>
        <div class="logo-strip">
            @foreach($partners as $x)<div class="logo-box">{{ $x->title }}</div>@endforeach
        </div>
    </div>
</section>
@endsection
