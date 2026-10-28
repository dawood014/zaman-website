@php($item = $property ?? $x ?? null)
@if($item)
<article class="property-card reveal" data-type="{{ $item->value('property_type') }}" data-status="{{ $item->value('property_status', $item->status) }}" data-area="{{ $item->value('area') }}" data-location="{{ $item->value('location') }}">
    <div class="property-image" style="background-image:url('{{ cms_media($item->value('image')) }}')">
        <span class="property-badge">{{ $item->value('property_status', $item->status) }}</span>
    </div>
    <div class="property-body">
        <div class="eyebrow">{{ $item->value('project') }} • {{ $item->value('property_type') }}</div>
        <h3>{{ $item->title }}</h3>
        <div class="property-meta">{{ $item->value('location') }}</div>
        <div class="property-meta">{{ $item->value('area') }} • {{ $item->value('payment') }}</div>
        <div class="property-price">{{ $item->value('price', 'Contact for Price') }}</div>
        <div class="property-actions">
            <a class="btn btn-dark btn-sm" href="{{ route('properties.show', $item->slug) }}">View Details</a>
            <button type="button" class="btn btn-outline btn-sm" onclick="navigator.clipboard?.writeText('{{ route('properties.show', $item->slug) }}').then(()=>alert('Property link copied.'))">Share</button>
        </div>
    </div>
</article>
@endif
