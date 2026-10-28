@extends('layouts.public')
@section('title', 'Properties | Zaman Build Tech & Real Estate')
@section('content')
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs"><a href="{{ route('home') }}">Home</a><span>›</span><span>Properties</span></div>
        <h1>Properties</h1>
        <p class="lead" style="color:#ddd;margin-top:15px">Search houses and plots by type, status, area and location, then open detailed property pages.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-head">
            <div><div class="eyebrow">Properties Introduction</div><h2>Ready houses and residential plots for buyers and investors.</h2></div>
            <p class="lead">Use the search filters to narrow listings, compare details and request a visit.</p>
        </div>
        <form class="search-panel" data-property-filters method="get">
            <div class="filter-span-2"><input name="q" value="{{ request('q') }}" placeholder="Search by title, project or location"></div>
            <select name="type"><option value="">All Types</option>@foreach(['House','Plot','Apartment','Commercial'] as $t)<option @selected(request('type')===$t)>{{ $t }}</option>@endforeach</select>
            <select name="status"><option value="">All Status</option>@foreach(['Available','Booked','Sold','For Rent'] as $s)<option @selected(request('status')===$s)>{{ $s }}</option>@endforeach</select>
            <select name="area"><option value="">All Areas</option>@foreach(['5 Marla','10 Marla'] as $a)<option @selected(request('area')===$a)>{{ $a }}</option>@endforeach</select>
            <button class="btn btn-orange" type="submit">Apply</button>
        </form>
        <div class="section-head"><div><div class="eyebrow">Featured & Available Listings</div><h2>Property listings.</h2></div></div>
        <div class="property-grid" data-property-grid>
            @forelse($properties as $x)
                @include('partials.property-card', ['property' => $x])
            @empty
                <div class="empty">No properties match your filters.</div>
            @endforelse
        </div>
        {{ $properties->links() }}
    </div>
</section>
<section class="section section-soft">
    <div class="container">
        <div class="section-head"><div><div class="eyebrow">Property Experience</div><h2>Each listing supports rich property details.</h2></div></div>
        <div class="cards">
            <div class="card"><h3>Image Gallery</h3><p>Multiple high-quality property images can be added to each listing from the admin panel.</p></div>
            <div class="card"><h3>Specifications & Amenities</h3><p>Area, bedrooms, payment plan, project, location, parking and additional features.</p></div>
            <div class="card"><h3>Floor Plans & Virtual Tours</h3><p>Sections for floor plan images, PDF plans or external 3D/360 tour links.</p></div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="two-col">
            <div><div class="eyebrow">Schedule a Visit</div><h2 class="title-lg">See the property before you decide.</h2><p class="lead" style="margin-top:15px">Send your preferred visit date and contact information.</p></div>
            <form method="post" action="{{ route('inquiry.store') }}">
                @csrf
                <input type="hidden" name="type" value="Property Visit">
                <div class="field"><label>Name</label><input name="name" required></div>
                <div class="field"><label>Phone</label><input name="phone" required></div>
                <div class="field"><label>Preferred Date</label><input name="subject" type="date" required></div>
                <div class="field full"><label>Message</label><textarea name="message" placeholder="Tell us which property you want to visit"></textarea></div>
                <div class="field full"><button class="btn btn-orange" type="submit">Request Visit</button></div>
            </form>
        </div>
    </div>
</section>
@endsection
