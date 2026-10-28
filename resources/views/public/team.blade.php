@extends('layouts.public')
@section('title', 'Team | Zaman Build Tech & Real Estate')
@section('content')
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs"><a href="{{ route('home') }}">Home</a><span>›</span><span>Our Team & Leadership</span></div>
        <h1>Our Team & Leadership</h1>
        <p class="lead" style="color:#ddd;margin-top:15px">Leadership, management, engineering, design and client support roles.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Leadership & Expertise</div>
                <h2>A professional team page ready for real names, bios and qualifications.</h2>
            </div>
            <p class="lead">Add the CEO, Managing Director, engineers and other staff when details are confirmed.</p>
        </div>
        <div class="team-grid">
            @forelse($team as $x)
                <div class="team-card reveal">
                    @if($x->value('image'))<img src="{{ cms_media($x->value('image')) }}" alt="{{ $x->value('name', $x->title) }}">@endif
                    <div class="body">
                        <h3>{{ $x->value('name', $x->title) }}</h3>
                        <small>{{ $x->value('role') }}</small>
                        <p>{{ $x->value('bio') }}</p>
                    </div>
                </div>
            @empty
                <div class="team-card"><img src="https://mffagroup.com/wp-content/uploads/2024/01/WhatsApp-Image-2024-01-19-at-18.10.36_f2dde378.jpg" alt="CEO"><div class="body"><h3>Chief Executive Officer</h3><small>Leadership & Strategy</small><p>Company direction, partnerships and long-term growth.</p></div></div>
                <div class="team-card"><img src="https://pha.gov.pk/peshawar_suruzair/new/3.jpg" alt="MD"><div class="body"><h3>Managing Director</h3><small>Operations & Business</small><p>Business operations, project coordination and customer delivery.</p></div></div>
            @endforelse
        </div>
    </div>
</section>
<section class="section section-soft">
    <div class="container">
        <div class="cta">
            <div>
                <div class="eyebrow">Work With Our Team</div>
                <h2>Start a construction, renovation or property conversation.</h2>
            </div>
            <a class="btn btn-orange" href="{{ route('contact') }}">Contact Us →</a>
        </div>
    </div>
</section>
@endsection
