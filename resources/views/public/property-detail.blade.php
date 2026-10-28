@extends('layouts.public')
@section('title', $item->title.' | Properties')
@section('content')
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs"><a href="{{ route('home') }}">Home</a><span>›</span><a href="{{ route('properties.index') }}">Properties</a><span>›</span><span>{{ $item->title }}</span></div>
        <h1>{{ $item->title }}</h1>
        <p class="lead" style="color:#ddd;margin-top:15px">{{ $item->value('location') }}</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="detail-layout">
            <div class="detail-image" style="background-image:url('{{ cms_media($item->value('image')) }}')"></div>
            <div class="detail-panel">
                <div class="eyebrow">{{ $item->value('project') }} • {{ $item->value('property_type') }}</div>
                <h2>{{ $item->value('price', 'Contact for Price') }}</h2>
                <div class="chips">
                    <span class="chip">{{ $item->value('area') }}</span>
                    <span class="chip">{{ $item->value('beds') }}</span>
                    <span class="chip">{{ $item->value('payment') }}</span>
                    <span class="chip">{{ $item->value('property_status', $item->status) }}</span>
                </div>
                <p class="lead">{{ $item->value('description') }}</p>
                <h3>Amenities</h3>
                <p>{{ $item->value('amenities', 'Contact us for full specifications.') }}</p>
                <div class="spec-grid" style="margin-top:20px">
                    <div class="spec"><small>Area</small><strong>{{ $item->value('area') }}</strong></div>
                    <div class="spec"><small>Status</small><strong>{{ $item->value('property_status', $item->status) }}</strong></div>
                    <div class="spec"><small>Bedrooms</small><strong>{{ $item->value('beds') }}</strong></div>
                    <div class="spec"><small>Payment</small><strong>{{ $item->value('payment') }}</strong></div>
                    <div class="spec"><small>Price</small><strong>{{ $item->value('price', 'Contact for Price') }}</strong></div>
                    <div class="spec"><small>Project</small><strong>{{ $item->value('project') }}</strong></div>
                </div>
                <div class="property-actions" style="margin-top:18px">
                    <a class="btn btn-orange" href="#visit">Schedule Visit</a>
                    <button type="button" class="btn btn-outline" data-property-whatsapp
                        data-title="{{ $item->title }}"
                        data-url="{{ route('properties.show', $item->slug) }}"
                        data-ref="{{ $item->value('reference', $item->slug) }}"
                        data-price="{{ $item->value('price') }}">WhatsApp Enquiry</button>
                    <button type="button" class="btn btn-outline" onclick="navigator.clipboard?.writeText('{{ route('properties.show', $item->slug) }}').then(()=>alert('Property link copied.'))">Share Property</button>
                    @if($item->value('floor_plan') || $item->value('floor_plan_file'))
                        <a class="btn btn-outline" href="{{ cms_media($item->value('floor_plan_file', $item->value('floor_plan'))) }}" target="_blank">Floor Plan</a>
                    @endif
                    @if($item->value('virtual_tour'))<a class="btn btn-outline" href="{{ $item->value('virtual_tour') }}" target="_blank">3D Tour</a>@endif
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section section-soft" id="visit">
    <div class="container">
        <div class="two-col">
            <div><h2>Schedule a Property Visit</h2><p class="lead">Send your preferred visit date and the team will follow up.</p></div>
            <form method="post" action="{{ route('inquiry.store') }}">
                @csrf
                <input type="hidden" name="type" value="Property Visit">
                <input type="hidden" name="reference" value="{{ $item->title }}">
                <div class="field"><label>Name</label><input name="name" required></div>
                <div class="field"><label>Phone</label><input name="phone" required></div>
                <div class="field"><label>Email</label><input type="email" name="email"></div>
                <div class="field"><label>Preferred Date</label><input name="preferred_date" type="date"></div>
                <div class="field"><label>Preferred Time</label><input name="preferred_time" type="time"></div>
                <div class="field full"><label>Message</label><textarea name="message"></textarea></div>
                <div class="field full"><button class="btn btn-orange" type="submit">Request Visit</button></div>
            </form>
        </div>
        <div class="map-wrap" style="margin-top:30px"><iframe loading="lazy" src="https://www.google.com/maps?q={{ urlencode($item->value('location')) }}&output=embed"></iframe></div>
    </div>
</section>
@if($related->count())
<section class="section">
    <div class="container">
        <div class="section-head"><div><div class="eyebrow">Similar Properties</div><h2>You may also like</h2></div></div>
        <div class="property-grid">
            @foreach($related as $x)
                @include('partials.property-card', ['property' => $x])
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
