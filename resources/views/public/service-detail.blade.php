@extends('layouts.public')
@section('title', $item->title . ' | Zaman Build Tech & Real Estate')
@section('content')
@php
    $features = $item->value('features');
    if (! is_array($features)) {
        $features = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $features)));
    }
@endphp
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs"><a href="{{ route('home') }}">Home</a><span>›</span><span>{{ $item->title }}</span></div>
        <h1>{{ $item->title }}</h1>
        <p class="lead" style="color:#ddd;margin-top:15px">{{ $item->value('summary') }}</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="two-col">
            <div class="image-panel" style="background-image:url('{{ cms_media($item->value('image')) }}')"></div>
            <div>
                <div class="eyebrow">Service Details</div>
                <h2 class="title-lg">{{ $item->title }}</h2>
                <p class="lead" style="margin-top:16px">{{ $item->value('details', $item->value('summary')) }}</p>
                @if(count($features))
                    <ul class="checklist">
                        @foreach($features as $line)
                            <li>{{ $line }}</li>
                        @endforeach
                    </ul>
                @endif
                <a class="btn btn-orange" style="margin-top:22px" href="{{ route('contact') }}#consultation">Request a Quote</a>
            </div>
        </div>
    </div>
</section>
<section class="section section-soft">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">How It Works</div>
                <h2>Simple and transparent service process.</h2>
            </div>
        </div>
        <div class="steps">
            @foreach($process as $x)
                <div class="step">
                    <b>{{ $x->value('step', $loop->iteration) }}</b>
                    <h3>{{ $x->title }}</h3>
                    @if($x->value('description'))<p>{{ $x->value('description') }}</p>@endif
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="cta">
            <div>
                <div class="eyebrow">Need This Service?</div>
                <h2>Talk to {{ $settings['company'] ?? 'Zaman Build Tech & Real Estate' }}.</h2>
            </div>
            <a class="btn btn-orange" href="{{ route('contact') }}">Contact Our Team →</a>
        </div>
    </div>
</section>
@endsection
