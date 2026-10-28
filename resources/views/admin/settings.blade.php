@extends('layouts.admin')

@section('title', 'Contact & Settings')

@section('content')
<div class="topbar">
    <div>
        <div class="kicker">Website Settings</div>
        <h1>Contact & Settings</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="post" action="{{ route('admin.settings.update') }}">
            @csrf
            @method('PUT')
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
        </form>
    </div>
</div>
@endsection
