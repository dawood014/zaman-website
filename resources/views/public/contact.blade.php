@extends('layouts.public')
@section('title', 'Contact | Zaman Build Tech & Real Estate')
@section('content')
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs"><a href="{{ route('home') }}">Home</a><span>›</span><span>Contact Us</span></div>
        <h1>Contact Us</h1>
        <p class="lead" style="color:#ddd;margin-top:15px">Speak to the team about construction, renovation, projects, properties or a free consultation.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-head">
            <div><div class="eyebrow">Contact Introduction</div><h2>Tell us what you are planning.</h2></div>
            <p class="lead">Submit your enquiry below. The team receives it in the admin panel and can follow up by phone, email or WhatsApp.</p>
        </div>
        <div class="contact-grid">
            <div class="contact-cards">
                <div class="contact-card"><strong>Phone</strong><a data-phone href="#">{{ $settings['phone'] ?? '+92 300 0000000' }}</a></div>
                <div class="contact-card"><strong>Email</strong><a data-email href="#">{{ $settings['email'] ?? 'info@zamanbuildtech.com' }}</a></div>
                <div class="contact-card"><strong>Address</strong><span data-address>{{ $settings['address'] ?? 'Warsak Road, Peshawar, Pakistan' }}</span></div>
                <div class="contact-card"><strong>Quick WhatsApp</strong><p>Use the floating WhatsApp button to start a direct enquiry.</p></div>
                <div class="contact-card"><strong>Working Hours</strong><p>{!! nl2br(e($settings['working_hours'] ?? "Monday–Saturday\n9:00 AM–6:00 PM")) !!}</p></div>
            </div>
            <form method="post" action="{{ route('inquiry.store') }}">
                @csrf
                <div class="field"><label>Name</label><input name="name" required value="{{ old('name') }}"></div>
                <div class="field"><label>Phone</label><input name="phone" required value="{{ old('phone') }}"></div>
                <div class="field"><label>Email</label><input name="email" type="email" value="{{ old('email') }}"></div>
                <div class="field"><label>Inquiry Type</label>
                    <select name="type">
                        @foreach(['Construction','Property','Project','Renovation','General'] as $type)
                            <option @selected(old('type')===$type)>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field full"><label>Message</label><textarea name="message" required placeholder="Tell us about your requirement">{{ old('message') }}</textarea></div>
                <div class="field full"><button class="btn btn-orange" type="submit">Send Inquiry</button></div>
            </form>
        </div>
    </div>
</section>
<section class="section section-soft">
    <div class="container">
        <div class="section-head"><div><div class="eyebrow">Office Location</div><h2>{{ $settings['address'] ?? 'Warsak Road, Peshawar' }}</h2></div></div>
        <div class="map-wrap"><iframe loading="lazy" src="{{ $settings['map_url'] ?? 'https://www.google.com/maps?q=Warsak%20Road%20Peshawar&output=embed' }}"></iframe></div>
    </div>
</section>
<section class="section" id="consultation">
    <div class="container"><div class="cta"><div><div class="eyebrow">Book a Free Consultation</div><h2>Construction, renovation or property — start with a discussion.</h2></div><a class="btn btn-orange" href="mailto:{{ $settings['email'] ?? 'info@zamanbuildtech.com' }}">Request Consultation →</a></div></div>
</section>
<section class="section section-soft">
    <div class="container">
        <div class="section-head"><div><div class="eyebrow">Contact FAQs</div><h2>Before you get in touch.</h2></div></div>
        <div class="faq">
            @foreach($faqs as $x)
                <details><summary>{{ $x->value('question', $x->title) }}</summary><p>{{ $x->value('answer') }}</p></details>
            @endforeach
        </div>
    </div>
</section>
@endsection
