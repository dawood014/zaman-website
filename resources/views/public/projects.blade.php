@extends('layouts.public')
@section('title', 'Projects | Zaman Build Tech & Real Estate')
@section('content')
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs"><a href="{{ route('home') }}">Home</a><span>›</span><span>Projects</span></div>
        <h1>Projects</h1>
        <p class="lead" style="color:#ddd;margin-top:15px">Browse featured developments, construction portfolios, progress details and location information.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Projects Introduction</div>
                <h2>Residential developments, construction work and renovation showcases.</h2>
            </div>
            <p class="lead">Filter projects by category or status, then open dedicated project pages for details, timelines, galleries and enquiries.</p>
        </div>
        <div class="stats-grid" style="margin-bottom:30px">
            @forelse($achievements->take(4) as $x)
                <div class="stat-card"><strong>{{ $x->value('value', $x->title) }}</strong><span>{{ $x->value('label', $x->title) }}</span><small>{{ $x->value('description') }}</small></div>
            @empty
                <div class="stat-card"><strong>Residential</strong><span>Homes & Villas</span><small>Construction and property</small></div>
                <div class="stat-card"><strong>Commercial</strong><span>Fit-Out & Renovation</span><small>Business spaces</small></div>
                <div class="stat-card"><strong>Ongoing</strong><span>Progress Tracking</span><small>Timeline presentation</small></div>
                <div class="stat-card"><strong>Upcoming</strong><span>Future Opportunities</span><small>Project launch space</small></div>
            @endforelse
        </div>
        <div class="filters" data-project-filters>
            <select name="category">
                <option value="">All Categories</option>
                @foreach(['Residential', 'Commercial', 'Industrial', 'Renovation'] as $cat)
                    <option @selected(request('category') === $cat)>{{ $cat }}</option>
                @endforeach
            </select>
            <select name="status">
                <option value="">All Statuses</option>
                @foreach(['Completed', 'Ongoing', 'Upcoming'] as $st)
                    <option @selected(request('status') === $st)>{{ $st }}</option>
                @endforeach
            </select>
        </div>
        <div class="project-grid">
            @foreach($projects as $x)
                <article class="project-card reveal" data-project-card data-category="{{ $x->value('category') }}" data-status="{{ $x->status }}">
                    <div class="project-image" style="background-image:url('{{ cms_media($x->value('image')) }}')">
                        <span class="project-badge">{{ $x->status }}</span>
                    </div>
                    <div class="project-body">
                        <div class="eyebrow">{{ $x->value('category') }}</div>
                        <h3>{{ $x->title }}</h3>
                        <p>{{ $x->value('summary') }}</p>
                        <a class="more" href="{{ route('projects.show', $x->slug) }}">Project Details →</a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@if($featured)
<section class="section section-soft">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Featured Project</div>
                <h2>{{ $featured->title }}</h2>
            </div>
        </div>
        <div class="two-col">
            <div class="image-panel" style="background-image:url('{{ cms_media($featured->value('image')) }}')"></div>
            <div>
                <p class="lead">{{ $featured->value('description', $featured->value('summary')) }}</p>
                <div class="chips">
                    <span class="chip">{{ $featured->value('category') }}</span>
                    <span class="chip">Houses</span>
                    <span class="chip">Plots</span>
                    <span class="chip">Cash</span>
                    <span class="chip">Installments</span>
                </div>
                <a class="btn btn-orange" href="{{ route('projects.show', $featured->slug) }}">Open Project Page</a>
            </div>
        </div>
    </div>
</section>
@endif
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Before & After</div>
                <h2>Project transformation showcase.</h2>
            </div>
        </div>
        @include('partials.cms-before-after', ['beforeAfter' => $beforeAfter])
    </div>
</section>
<section class="section section-soft">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Success Stories</div>
                <h2>Client testimonial space for project-specific reviews.</h2>
            </div>
        </div>
        @include('partials.cms-testimonials', ['testimonials' => $testimonials])
    </div>
</section>
@endsection
