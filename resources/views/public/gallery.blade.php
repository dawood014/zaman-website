@extends('layouts.public')
@section('title', 'Gallery | Zaman Build Tech & Real Estate')
@section('content')
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs"><a href="{{ route('home') }}">Home</a><span>›</span><span>Project Gallery</span></div>
        <h1>Project Gallery</h1>
        <p class="lead" style="color:#ddd;margin-top:15px">Construction, renovation, property and before/after visual showcase.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Gallery</div>
                <h2>Project and property visuals.</h2>
            </div>
        </div>
        <div class="gallery-grid">
            @forelse($gallery as $x)
                <img src="{{ cms_media($x->value('image')) }}" alt="{{ $x->value('caption', $x->title) }}">
            @empty
                <img src="https://respak.pk/wp-content/uploads/2026/01/WhatsApp-Image-2026-01-14-at-2.37.46-PM.jpeg" alt="Gallery">
                <img src="https://media.zameen.com/thumbnails/199856624-800x600.jpeg" alt="Gallery">
            @endforelse
        </div>
    </div>
</section>
<section class="section section-soft">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Before & After Showcase</div>
                <h2>Transformation view.</h2>
            </div>
        </div>
        @include('partials.cms-before-after', ['beforeAfter' => $beforeAfter])
    </div>
</section>
@endsection
