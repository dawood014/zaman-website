@extends('layouts.public')
@section('title', 'Services | Zaman Build Tech & Real Estate')
@section('content')
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs"><a href="{{ route('home') }}">Home</a><span>›</span><span>Construction Services</span></div>
        <h1>Construction Services</h1>
        <p class="lead" style="color:#ddd;margin-top:15px">Detailed service pages for construction, renovation, planning, management, fit-out and property support.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Services Introduction</div>
                <h2>Support for new builds, improvements and property decisions.</h2>
            </div>
            <p class="lead">Choose a service to open a dedicated page with scope, process, deliverables and enquiry options.</p>
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
        <div class="section-head">
            <div>
                <div class="eyebrow">Why Our Services</div>
                <h2>Structured around clarity and practical delivery.</h2>
            </div>
        </div>
        <div class="cards">
            @forelse(($whyChoose ?? collect()) as $x)
                <div class="card"><h3>{{ $x->title }}</h3><p>{{ $x->value('description') }}</p></div>
            @empty
                <div class="card"><h3>Defined Scope</h3><p>Clear service breakdowns help customers understand what is included and what comes next.</p></div>
                <div class="card"><h3>Site Coordination</h3><p>Planning and execution are connected through practical supervision and progress communication.</p></div>
                <div class="card"><h3>One Business Relationship</h3><p>Construction, renovation and property support stay under one company brand.</p></div>
            @endforelse
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Construction Process</div>
                <h2>From initial discussion to handover.</h2>
            </div>
        </div>
        <div class="steps">
            @foreach($process as $x)
                <div class="step"><b>{{ $x->value('step', $loop->iteration) }}</b><h3>{{ $x->title }}</h3>@if($x->value('description'))<p>{{ $x->value('description') }}</p>@endif</div>
            @endforeach
        </div>
    </div>
</section>
<section class="section section-soft">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Completed Projects Gallery</div>
                <h2>Construction and renovation visual showcase.</h2>
            </div>
            <a class="btn btn-outline" href="{{ route('gallery') }}">Full Gallery</a>
        </div>
        <div class="gallery-grid">
            @foreach($gallery->take(6) as $x)
                <img src="{{ cms_media($x->value('image')) }}" alt="{{ $x->value('caption', $x->title) }}">
            @endforeach
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Before & After</div>
                <h2>Renovation transformation.</h2>
            </div>
        </div>
        @include('partials.cms-before-after', ['beforeAfter' => $beforeAfter])
    </div>
</section>
<section class="section section-soft">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Client Testimonials</div>
                <h2>Feedback section.</h2>
            </div>
        </div>
        @include('partials.cms-testimonials', ['testimonials' => $testimonials])
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">FAQs</div>
                <h2>Service questions.</h2>
            </div>
        </div>
        @include('partials.cms-faqs', ['faqs' => $faqs])
    </div>
</section>
@endsection
