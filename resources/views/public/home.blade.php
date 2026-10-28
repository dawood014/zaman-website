@extends('layouts.public')
@section('title', 'Home | Zaman Build Tech & Real Estate')
@section('content')
<section class="hero-video">
    @php($heroMedia = cms_media($hero?->value('media_upload', $hero?->value('media'))))
    <video autoplay muted loop playsinline poster="{{ cms_media($hero?->value('poster')) }}">
        <source src="{{ $heroMedia }}" type="video/webm">
    </video>
    <div class="container inner">
        <div class="reveal">
            <div class="eyebrow">{{ $settings['company'] ?? 'Zaman Build Tech & Real Estate' }}</div>
            <h1>{!! $hero?->value('heading', 'Build with confidence.<br><em>Invest with clarity.</em>') !!}</h1>
            <p>{{ $hero?->value('subheading', 'Construction, renovation, ready-made houses and residential plots in Peshawar — with selected property options available on cash and installment plans.') }}</p>
            <div class="hero-actions">
                <a class="btn btn-orange" href="{{ $hero?->value('link', route('projects.index')) }}">{{ $hero?->value('cta', 'Explore Projects →') }}</a>
                @if($hero?->value('link_secondary') || $hero?->value('cta_secondary'))
                    <a class="btn btn-outline" href="{{ $hero?->value('link_secondary', route('properties.index')) }}">{{ $hero?->value('cta_secondary', 'View Properties') }}</a>
                @else
                    <a class="btn btn-outline" href="{{ route('properties.index') }}">View Properties</a>
                @endif
            </div>
        </div>
        <div class="hero-note reveal">
            <strong>From concept to ownership</strong>
            <span>One team for construction, renovation, property sales, site visits and project enquiries.</span>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="two-col">
            <div>
                <div class="eyebrow">Who We Are</div>
                <h2 class="title-lg">A local construction and real estate company focused on practical delivery.</h2>
                <p class="lead" style="margin-top:18px">Based on Warsak Road, Peshawar, Zaman Build Tech & Real Estate supports clients who want to build, renovate, buy a ready house or invest in residential plots.</p>
                <a class="btn btn-orange" style="margin-top:22px" href="{{ route('about') }}">Learn About Us →</a>
            </div>
            <div class="image-panel" style="background-image:url('https://media.zameen.com/thumbnails/199856624-800x600.jpeg')"></div>
        </div>
    </div>
</section>

<section class="section section-soft">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Company Highlights</div>
                <h2>What our business is built around.</h2>
            </div>
            <a class="btn btn-outline" href="{{ route('achievements') }}">Achievements & Profile</a>
        </div>
        <div class="stats-grid">
            @forelse($achievements as $x)
                <div class="stat-card"><strong>{{ $x->value('value', $x->title) }}</strong><span>{{ $x->value('label', $x->title) }}</span><small>{{ $x->value('description') }}</small></div>
            @empty
                <div class="stat-card"><strong>Peshawar</strong><span>Local Market Focus</span><small>Warsak Road and surrounding areas</small></div>
                <div class="stat-card"><strong>360°</strong><span>Property Support</span><small>Build, renovate, buy and invest</small></div>
                <div class="stat-card"><strong>Cash +</strong><span>Installment Options</span><small>For selected houses and plots</small></div>
                <div class="stat-card"><strong>Quality</strong><span>Execution Focus</span><small>Planning, supervision and finishing</small></div>
            @endforelse
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">What We Do</div>
                <h2>Construction services for homes, businesses and property investors.</h2>
            </div>
            <p class="lead">Each service has a dedicated page so customers can understand scope, process, deliverables and enquiry options.</p>
        </div>
        <div class="service-grid">
            @foreach($services as $x)
                <article class="service-card reveal">
                    <img src="{{ cms_media($x->value('image')) }}" alt="{{ $x->title }}">
                    <div class="content">
                        <h3>{{ $x->title }}</h3>
                        <p>{{ $x->value('summary') }}</p>
                        <a class="more" href="{{ route('services.show', $x->slug) }}">Explore service →</a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section section-dark">
    <div class="container">
        <div class="section-head"><div><div class="eyebrow">Why Choose Us</div><h2>Clear communication. Practical planning. Local support.</h2></div></div>
        <div class="cards">
            @foreach($whyChoose as $x)
                <div class="card"><h3>{{ $x->title }}</h3><p>{{ $x->value('description') }}</p></div>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div><div class="eyebrow">Featured Projects</div><h2>Professional project presentation with progress, location and property links.</h2></div>
            <a class="btn btn-outline" href="{{ route('projects.index') }}">All Projects</a>
        </div>
        <div class="project-grid">
            @foreach($projects->take(3) as $x)
                <article class="project-card" data-project-card data-category="{{ $x->value('category') }}" data-status="{{ $x->status }}">
                    <div class="project-image" style="background-image:url('{{ cms_media($x->value('image')) }}')"><span class="project-badge">{{ $x->status }}</span></div>
                    <div class="project-body">
                        <div class="eyebrow">{{ $x->value('category') }}</div>
                        <h3>{{ $x->title }}</h3>
                        <p class="lead">{{ $x->value('summary') }}</p>
                        <a class="more" href="{{ route('projects.show', $x->slug) }}">View Project →</a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section section-soft">
    <div class="container">
        <div class="section-head">
            <div><div class="eyebrow">Featured Properties</div><h2>Ready houses and plots presented with clear details.</h2></div>
            <a class="btn btn-outline" href="{{ route('properties.index') }}">Browse All</a>
        </div>
        <div class="property-grid" data-property-grid>
            @foreach($properties as $x)
                @include('partials.property-card', ['property' => $x])
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head"><div><div class="eyebrow">Our Process</div><h2>A simple path from first discussion to delivery.</h2></div></div>
        <div class="steps">
            @foreach($process as $x)
                <div class="step"><b>{{ $x->value('step') }}</b><h3>{{ $x->title }}</h3><p>{{ $x->value('description') }}</p></div>
            @endforeach
        </div>
    </div>
</section>

<section class="section section-soft">
    <div class="container">
        <div class="section-head">
            <div><div class="eyebrow">Before & After</div><h2>Project transformation showcase.</h2></div>
            <a class="btn btn-outline" href="{{ route('gallery') }}">Open Gallery</a>
        </div>
        <div class="before-after">
            @foreach($beforeAfter as $x)
                <div class="ba-card"><img src="{{ cms_media($x->value('before_image')) }}" alt="Before {{ $x->title }}"><span>Before — {{ $x->title }}</span></div>
                <div class="ba-card"><img src="{{ cms_media($x->value('after_image')) }}" alt="After {{ $x->title }}"><span>After — {{ $x->title }}</span></div>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head"><div><div class="eyebrow">Client Feedback</div><h2>Testimonials & reviews.</h2></div></div>
        <div class="testimonials">
            @foreach($testimonials as $x)
                <div class="quote-card">
                    <div class="stars">{{ str_repeat('★', min(5, max(1, (int) $x->value('rating', 5)))) }}</div>
                    <p>“{{ $x->value('quote') }}”</p>
                    <strong>{{ $x->value('client', $x->title) }}</strong>
                    <small>{{ $x->value('role') }}</small>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section section-soft">
    <div class="container">
        <div class="section-head">
            <div><div class="eyebrow">Our Team</div><h2>Leadership, site expertise and delivery support.</h2></div>
            <a class="btn btn-outline" href="{{ route('team') }}">Meet the Team</a>
        </div>
        <div class="team-grid">
            @foreach($team as $x)
                <div class="team-card">
                    @if($x->value('image'))<img src="{{ cms_media($x->value('image')) }}" alt="{{ $x->value('name', $x->title) }}">@endif
                    <div class="body"><h3>{{ $x->value('name', $x->title) }}</h3><small>{{ $x->value('role') }}</small><p>{{ $x->value('bio') }}</p></div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head"><div><div class="eyebrow">Trust & Partnerships</div><h2>Certifications, partners and trusted clients.</h2></div></div>
        <div class="logo-strip">
            @forelse($partners as $x)
                <div class="logo-box">
                    @if($x->value('logo'))<img src="{{ cms_media($x->value('logo')) }}" alt="{{ $x->title }}" style="max-height:44px;max-width:120px"><br>@endif
                    {{ $x->title }}
                </div>
            @empty
                <div class="logo-box">Certification / Registration</div>
                <div class="logo-box">Material Partner</div>
                <div class="logo-box">Engineering Partner</div>
                <div class="logo-box">Trusted Client</div>
                <div class="logo-box">Business Partner</div>
            @endforelse
        </div>
    </div>
</section>

<section class="section section-soft">
    <div class="container">
        <div class="section-head">
            <div><div class="eyebrow">Latest Insights</div><h2>Construction news, property guidance and updates.</h2></div>
            <a class="btn btn-outline" href="{{ route('news.index') }}">View All News</a>
        </div>
        <div class="news-grid">
            @foreach($news as $x)
                <article class="news-card">
                    @if($x->value('image'))<img src="{{ cms_media($x->value('image')) }}" alt="{{ $x->title }}">@endif
                    <div class="body"><small>{{ $x->value('category') }}</small><h3>{{ $x->title }}</h3><a class="more" href="{{ route('news.show', $x->slug) }}">Read more →</a></div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head"><div><div class="eyebrow">FAQs</div><h2>Common customer questions.</h2></div></div>
        <div class="faq">
            @foreach($faqs as $x)
                <details><summary>{{ $x->value('question', $x->title) }}</summary><p>{{ $x->value('answer') }}</p></details>
            @endforeach
        </div>
    </div>
</section>

<section class="section section-soft" id="consultation">
    <div class="container">
        <div class="cta">
            <div>
                <div class="eyebrow">Free Consultation</div>
                <h2>{{ $consultation?->title ?? 'Planning a construction project or property purchase?' }}</h2>
                @if($consultation?->value('description'))<p class="lead">{{ $consultation->value('description') }}</p>@endif
            </div>
            <a class="btn btn-orange" href="{{ route('contact') }}#consultation">Request a Quote →</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="two-col">
            <div>
                <div class="eyebrow">Visit & Contact</div>
                <h2 class="title-lg">{{ $settings['address'] ?? 'Warsak Road, Peshawar' }}</h2>
                <p class="lead" style="margin-top:15px">Call, email or WhatsApp the team to discuss construction, renovation, Zaman Villas, property listings or a site visit.</p>
                <div class="chips"><span class="chip" data-phone>{{ $settings['phone'] ?? '+92 300 0000000' }}</span><span class="chip" data-email>{{ $settings['email'] ?? 'info@zamanbuildtech.com' }}</span></div>
                <a class="btn btn-orange" href="{{ route('contact') }}">Contact Us</a>
            </div>
            <div class="map-wrap"><iframe loading="lazy" src="https://www.google.com/maps?q=Warsak%20Road%20Peshawar&output=embed"></iframe></div>
        </div>
    </div>
</section>
@endsection
