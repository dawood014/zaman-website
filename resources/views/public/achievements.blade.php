@extends('layouts.public')
@section('title', 'Achievements | Zaman Build Tech & Real Estate')
@section('content')
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs"><a href="{{ route('home') }}">Home</a><span>›</span><span>Achievements & Company Profile</span></div>
        <h1>Achievements & Company Profile</h1>
        <p class="lead" style="color:#ddd;margin-top:15px">A dedicated space for verified company milestones, registrations, completed work and future growth.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Company Achievements</div>
                <h2>Professional profile without unverified claims.</h2>
            </div>
            <p class="lead">Replace placeholder cards with verified figures when the company provides them.</p>
        </div>
        <div class="stats-grid">
            @forelse($achievements as $x)
                <div class="stat-card"><strong>{{ $x->value('value', $x->title) }}</strong><span>{{ $x->value('label', $x->title) }}</span><small>{{ $x->value('description') }}</small></div>
            @empty
                <div class="stat-card"><strong>Peshawar</strong><span>Operating Base</span><small>Warsak Road</small></div>
                <div class="stat-card"><strong>2-in-1</strong><span>Construction + Real Estate</span><small>Integrated customer support</small></div>
                <div class="stat-card"><strong>Flexible</strong><span>Property Purchase</span><small>Cash and installment options</small></div>
                <div class="stat-card"><strong>Growing</strong><span>Project Portfolio</span><small>Ready for verified additions</small></div>
            @endforelse
        </div>
    </div>
</section>
<section class="section section-soft">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="eyebrow">Certifications & Recognition</div>
                <h2>Add verified documents and logos here.</h2>
            </div>
        </div>
        <div class="logo-strip">
            @forelse($partners as $x)
                <div class="logo-box">
                    @if($x->value('logo'))<img src="{{ cms_media($x->value('logo')) }}" alt="{{ $x->title }}" style="max-height:44px;max-width:120px"><br>@endif
                    {{ $x->title }}
                </div>
            @empty
                <div class="logo-box">Company Registration</div>
                <div class="logo-box">Engineering Certificate</div>
                <div class="logo-box">Tax / Business Record</div>
                <div class="logo-box">Partner Recognition</div>
                <div class="logo-box">Client Recognition</div>
            @endforelse
        </div>
    </div>
</section>
@endsection
