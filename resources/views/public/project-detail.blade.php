@extends('layouts.public')
@section('title', $item->title . ' | Zaman Build Tech & Real Estate')
@section('content')
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs"><a href="{{ route('home') }}">Home</a><span>›</span><a href="{{ route('projects.index') }}">Projects</a><span>›</span><span>{{ $item->title }}</span></div>
        <h1>{{ $item->title }}</h1>
        <p class="lead" style="color:#ddd;margin-top:15px">{{ $item->value('location') }} — {{ $item->value('summary') }}</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="two-col">
            <div class="image-panel" style="background-image:url('{{ cms_media($item->value('image')) }}')"></div>
            <div>
                <div class="eyebrow">Featured Development</div>
                <h2 class="title-lg">{{ $item->title }}</h2>
                <p class="lead" style="margin-top:16px">{{ $item->value('description', $item->value('summary')) }}</p>
                <div class="chips">
                    <span class="chip">{{ $item->value('category') }}</span>
                    <span class="chip">{{ $item->status }}</span>
                    @if($item->value('progress'))<span class="chip">Progress: {{ $item->value('progress') }}%</span>@endif
                </div>
                <a class="btn btn-orange" href="{{ route('contact') }}?type=Project&reference={{ urlencode($item->title) }}">Enquire About Project</a>
                @if($properties->isNotEmpty())
                    <a class="btn btn-outline" style="margin-left:10px" href="{{ route('properties.index') }}?project={{ urlencode($item->title) }}">View Available Properties</a>
                @endif
            </div>
        </div>
    </div>
</section>
<section class="section section-soft">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Project Progress</div>
                <h2>Construction & development timeline.</h2>
            </div>
        </div>
        @php
            $timeline = $item->value('timeline');
            if (! is_array($timeline) || ! count($timeline)) {
                $timeline = [
                    ['title' => 'Planning & Site Preparation', 'text' => 'Project planning, site organization and development preparation.'],
                    ['title' => 'Infrastructure & Construction', 'text' => 'Road access, residential construction and plot development activities.'],
                    ['title' => 'Property Availability', 'text' => 'Selected houses and plots listed for customer enquiry and booking.'],
                    ['title' => 'Ongoing Sales & Development', 'text' => 'Continue updating availability, project progress and customer visit schedules.'],
                ];
            }
        @endphp
        <div class="timeline">
            @foreach($timeline as $step)
                <div class="timeline-item">
                    <h3>{{ is_array($step) ? ($step['title'] ?? '') : $step }}</h3>
                    @if(is_array($step) && ! empty($step['text']))<p>{{ $step['text'] }}</p>@endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@if($gallery->isNotEmpty())
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Project Gallery</div>
                <h2>Houses, plots and development visuals.</h2>
            </div>
        </div>
        <div class="gallery-grid">
            @foreach($gallery->take(6) as $x)
                <img src="{{ cms_media($x->value('image')) }}" alt="{{ $x->value('caption', $x->title) }}">
            @endforeach
        </div>
    </div>
</section>
@endif
@if($item->value('location'))
<section class="section section-soft">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Project Location</div>
                <h2>{{ $item->value('location') }}</h2>
            </div>
            @if($item->value('map_url'))
                <a class="btn btn-orange" target="_blank" rel="noopener" href="{{ $item->value('map_url') }}">Open Directions</a>
            @endif
        </div>
        <div class="map-wrap">
            <iframe loading="lazy" title="Map" src="https://www.google.com/maps?q={{ urlencode($item->value('location')) }}&output=embed"></iframe>
        </div>
    </div>
</section>
@endif
@if($properties->isNotEmpty())
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Available Properties</div>
                <h2>Houses and plots in {{ $item->title }}.</h2>
            </div>
        </div>
        <div class="property-grid" data-property-grid>
            @foreach($properties as $p)
                @include('partials.property-card', ['property' => $p])
            @endforeach
        </div>
    </div>
</section>
@endif
@if($related->isNotEmpty())
<section class="section section-soft">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Related Projects</div>
                <h2>Explore more work.</h2>
            </div>
        </div>
        <div class="project-grid">
            @foreach($related as $x)
                <article class="project-card">
                    <div class="project-image" style="background-image:url('{{ cms_media($x->value('image')) }}')"></div>
                    <div class="project-body">
                        <h3>{{ $x->title }}</h3>
                        <a class="more" href="{{ route('projects.show', $x->slug) }}">View →</a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
