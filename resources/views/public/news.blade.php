@extends('layouts.public')
@section('title', 'News & Insights | Zaman Build Tech & Real Estate')
@section('content')
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs"><a href="{{ route('home') }}">Home</a><span>›</span><span>News & Construction Insights</span></div>
        <h1>News & Construction Insights</h1>
        <p class="lead" style="color:#ddd;margin-top:15px">Useful construction, renovation and property guidance for customers and investors.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Latest Articles</div>
                <h2>Construction and property insights.</h2>
            </div>
        </div>
        <div class="news-grid">
            @foreach($news as $x)
                <article class="news-card reveal">
                    @if($x->value('image'))<img src="{{ cms_media($x->value('image')) }}" alt="{{ $x->title }}">@endif
                    <div class="body">
                        <small>{{ $x->value('category') }}</small>
                        <h3>{{ $x->title }}</h3>
                        <p>{{ $x->value('excerpt') }}</p>
                        <a class="more" href="{{ route('news.show', $x->slug) }}">Read more →</a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endsection
