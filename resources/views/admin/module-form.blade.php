@extends('layouts.admin')

@section('title', ($item->exists ? 'Edit ' : 'Add ').$cfg['label'])

@section('content')
<div class="topbar">
    <div>
        <div class="kicker">{{ $cfg['label'] }}</div>
        <h1>{{ $item->exists ? 'Edit' : 'Add' }} Item</h1>
    </div>
</div>

@if($errors->any())
    <div class="notice show" style="background:#fff0ee;color:#b42318">{{ implode(' • ', $errors->all()) }}</div>
@endif

@if($module === 'achievements')
    <p class="help" style="margin:-8px 0 18px">Homepage statistics use <strong>Value</strong> and <strong>Label</strong>. Set status to <strong>Published</strong> (or Active) so they appear on the website.</p>
@elseif($module === 'home-sections')
    <p class="help" style="margin:-8px 0 18px">The homepage <strong>Who We Are</strong> block uses the item with slug <code>who-we-are</code> (or the first published item). Use <strong>Button URL</strong> for paths like <code>/about</code> or full links.</p>
@elseif($module === 'social')
    <p class="help" style="margin:-8px 0 18px">Enter the full profile URL (must start with <code>https://</code>). Icons only appear on the site when the URL is valid. Links open in a new tab.</p>
@endif

<div class="card">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data" action="{{ $item->exists ? route('admin.module.update', [$module, $item]) : route('admin.module.store', $module) }}">
            @csrf
            @if($item->exists)
                @method('PUT')
            @endif
            <div class="form-grid">
                <div class="field">
                    <label>
                        @if($module === 'why-choose')
                            Reason Title
                        @elseif($module === 'achievements')
                            Admin Title <span class="help">(optional — label is shown on site)</span>
                        @else
                            Title
                        @endif
                    </label>
                    <input name="title" value="{{ old('title', $item->title) }}" @unless($module === 'achievements') required @endunless>
                </div>
                <div class="field">
                    <label>Slug</label>
                    <input name="slug" value="{{ old('slug', $item->slug) }}" placeholder="auto-generated if blank">
                </div>
                <div class="field">
                    <label>Status</label>
                    <select name="status">
                        @foreach(['Published', 'Active', 'Available', 'Ongoing', 'Completed', 'Draft', 'Hidden', 'Sold', 'Booked'] as $s)
                            <option @selected(old('status', $item->status) === $s)>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}">
                </div>

                @foreach($cfg['fields'] as $field)
                    @php($val = old('f_'.$field['name'], data_get($item->data, $field['name'])))
                    <div class="field {{ in_array($field['type'], ['textarea', 'image', 'file'], true) ? 'full' : '' }}">
                        <label>{{ $field['label'] }}</label>
                        @if(str_starts_with($field['type'], 'select:'))
                            <select name="f_{{ $field['name'] }}">
                                @foreach(explode('|', substr($field['type'], 7)) as $o)
                                    <option @selected($val === $o)>{{ $o }}</option>
                                @endforeach
                            </select>
                        @elseif($field['type'] === 'textarea')
                            <textarea name="f_{{ $field['name'] }}">{{ $val }}</textarea>
                        @elseif($field['type'] === 'image')
                            @if($val)
                                <div style="margin-bottom:10px">
                                    <img src="{{ str_starts_with($val, 'http') ? $val : asset($val) }}" style="max-width:220px;max-height:130px;object-fit:cover" alt="">
                                </div>
                            @endif
                            <input type="file" name="f_{{ $field['name'] }}" accept="image/*">
                        @elseif($field['type'] === 'file')
                            @if($val)
                                <p class="help">{{ $val }}</p>
                            @endif
                            <input type="file" name="f_{{ $field['name'] }}">
                        @else
                            <input type="{{ $field['type'] }}" name="f_{{ $field['name'] }}" value="{{ $val }}">
                        @endif
                    </div>
                @endforeach

                <div class="field full">
                    <div class="actions">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a class="btn btn-light" href="{{ route('admin.module.index', $module) }}">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
