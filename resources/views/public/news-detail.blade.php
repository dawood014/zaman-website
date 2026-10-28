@extends('layouts.public')
@section('title', $item->title . ' | Zaman Build Tech & Real Estate')
@section('content')
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs"><a href="{{ route('home') }}">Home</a><span>›</span><a href="{{ route('news.index') }}">News</a><span>›</span><span>{{ $item->title }}</span></div>
        <div class="eyebrow">{{ $item->value('category') }}</div>
        <h1>{{ $item->title }}</h1>
    </div>
</section>
<section class="section">
    <div class="container" style="max-width:850px">
        @if($item->value('image'))
            <img style="width:100%;border-radius:14px;margin-bottom:28px" src="{{ cms_media($item->value('image')) }}" alt="{{ $item->title }}">
        @endif
        <div class="lead" style="white-space:pre-line">{{ $item->value('content', $item->value('excerpt')) }}</div>
        <a class="btn btn-outline" style="margin-top:28px" href="{{ route('news.index') }}">← Back to News</a>
    </div>
</section>
@endsection
