<div class="testimonials">
    @forelse(($testimonials ?? collect()) as $x)
        <div class="quote-card">
            <div class="stars">{{ str_repeat('★', min(5, max(1, (int) $x->value('rating', 5)))) }}</div>
            <p>“{{ $x->value('quote') }}”</p>
            <strong>{{ $x->value('client', $x->title) }}</strong>
            @if($x->value('role'))<small>{{ $x->value('role') }}</small>@endif
        </div>
    @empty
        <div class="quote-card"><div class="stars">★★★★★</div><p>“Clear planning and professional coordination from the first discussion.”</p><strong>Client</strong></div>
        <div class="quote-card"><div class="stars">★★★★★</div><p>“The renovation process was easy to understand and well organized.”</p><strong>Renovation Client</strong></div>
        <div class="quote-card"><div class="stars">★★★★★</div><p>“Helpful communication throughout the project.”</p><strong>Project Client</strong></div>
    @endforelse
</div>
