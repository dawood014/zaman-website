@if(($beforeAfter ?? collect())->isNotEmpty())
    <div class="before-after">
        @foreach($beforeAfter as $x)
            <div class="ba-card"><img src="{{ cms_media($x->value('before_image')) }}" alt="Before {{ $x->title }}"><span>Before</span></div>
            <div class="ba-card"><img src="{{ cms_media($x->value('after_image')) }}" alt="After {{ $x->title }}"><span>After</span></div>
        @endforeach
    </div>
@endif
