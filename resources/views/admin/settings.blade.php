@extends('layouts.admin')

@section('title', 'Contact & Settings')

@section('content')
<div class="topbar">
    <div>
        <div class="kicker">Website Settings</div>
        <h1>Contact & Settings</h1>
    </div>
</div>

@if($errors->any())
    <div class="notice show" style="background:#fff0ee;color:#b42318">{{ implode(' • ', $errors->all()) }}</div>
@endif

<form method="post" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-head"><h2>Branding</h2></div>
        <div class="card-body">
            <div class="form-grid">
                <div class="field full">
                    <label>Website Logo (header & footer)</label>
                    @if(! empty($settings['site_logo']))
                        <div style="margin-bottom:10px;padding:12px;background:#fafafa;border:1px solid var(--line);border-radius:8px;display:inline-block">
                            <img src="{{ site_logo_url($settings) }}" alt="Current logo" style="max-height:80px;max-width:260px;object-fit:contain">
                        </div>
                    @else
                        <p class="help">Using default logo at <code>public/assets/logo.png</code> until you upload one.</p>
                    @endif
                    <input type="file" name="site_logo" accept="image/*">
                    <p class="help">PNG or JPG recommended. Max 5 MB.</p>
                </div>
                <div class="field full">
                    <label>Favicon</label>
                    @if(! empty($settings['favicon']))
                        <div style="margin-bottom:10px">
                            <img src="{{ cms_media($settings['favicon']) }}" alt="Favicon" style="width:32px;height:32px;object-fit:contain">
                        </div>
                    @endif
                    <input type="file" name="favicon" accept="image/*">
                    <p class="help">Square icon for browser tabs. Max 2 MB.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-head"><h2>Company & Contact</h2></div>
        <div class="card-body">
            <div class="form-grid">
                @foreach([
                    'company' => 'Company Name',
                    'tagline' => 'Tagline',
                    'address' => 'Address',
                    'email' => 'Email',
                    'phone' => 'Phone',
                    'whatsapp' => 'WhatsApp',
                    'map_url' => 'Google Maps URL',
                    'working_hours' => 'Working Hours',
                ] as $k => $label)
                    <div class="field {{ in_array($k, ['address', 'map_url', 'working_hours'], true) ? 'full' : '' }}">
                        <label>{{ $label }}</label>
                        <input name="{{ $k }}" value="{{ old($k, $settings[$k] ?? '') }}">
                    </div>
                @endforeach
                <div class="field full">
                    <button class="btn btn-primary" type="submit">Save Settings</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
