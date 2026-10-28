@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="topbar">
    <div>
        <div class="kicker">Admin Panel</div>
        <h1>Dashboard</h1>
        <p>Overview of website content and administration.</p>
    </div>
    <div class="top-actions">
        <a class="btn btn-light" href="{{ route('home') }}" target="_blank">View Website</a>
    </div>
</div>
<div class="grid stats">
    <div class="stat"><small>Services</small><strong>{{ $counts['services'] ?? 0 }}</strong></div>
    <div class="stat"><small>Projects</small><strong>{{ $counts['projects'] ?? 0 }}</strong></div>
    <div class="stat"><small>Properties</small><strong>{{ $counts['properties'] ?? 0 }}</strong></div>
    <div class="stat"><small>New Inquiries</small><strong>{{ $newInquiries }}</strong></div>
</div>
<div class="card">
    <div class="card-head"><h2>Content Management</h2></div>
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Module</th><th>Records</th><th></th></tr>
            </thead>
            <tbody>
                @foreach($modules as $key => $label)
                    <tr>
                        <td><strong>{{ $label }}</strong></td>
                        <td>{{ $counts[$key] ?? 0 }}</td>
                        <td><a class="preview-link" href="{{ route('admin.module.index', $key) }}">Manage →</a></td>
                    </tr>
                @endforeach
                <tr>
                    <td><strong>Inquiries & Bookings</strong></td>
                    <td>{{ $inquiryTotal }}</td>
                    <td><a class="preview-link" href="{{ route('admin.inquiries') }}">Manage →</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="card">
    <div class="card-head"><h2>Recent Inquiries</h2></div>
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Date</th><th>Name</th><th>Type</th><th>Status</th></tr>
            </thead>
            <tbody>
                @forelse($recent as $x)
                    <tr>
                        <td>{{ $x->created_at->format('d M Y') }}</td>
                        <td>{{ $x->name }}</td>
                        <td>{{ $x->type }}</td>
                        <td>{{ $x->status }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">No inquiries yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
