@foreach(($social ?? collect()) as $link)
    @php($href = valid_external_url($link->value('url')))
    @if($href)
        <a href="{{ $href }}" target="_blank" rel="noopener noreferrer" title="{{ $link->value('platform', $link->title) }}">{{ $link->value('icon', $link->value('platform', 'Link')) }}</a>
    @endif
@endforeach
