@extends('layouts.admin')
@section('title', 'Inquiries & Bookings')
@section('content')
<div class="topbar">
    <div>
        <div class="kicker">Leads</div>
        <h1>Inquiries & Bookings</h1>
        <p>Contact forms, property visits and general enquiries.</p>
    </div>
</div>
<form class="card card-body" method="get" style="margin-bottom:18px">
    <div class="form-grid">
        <div class="field">
            <label>Type</label>
            <select name="type">
                <option value="">All types</option>
                @foreach(['Construction', 'Property', 'Property Visit', 'Project', 'General'] as $t)
                    <option value="{{ $t }}" @selected($filterType === $t)>{{ $t }}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label>Status</label>
            <select name="status">
                <option value="">All statuses</option>
                @foreach(['New', 'In Progress', 'Closed'] as $s)
                    <option value="{{ $s }}" @selected($filterStatus === $s)>{{ $s }}</option>
                @endforeach
            </select>
        </div>
        <div class="field" style="align-self:end">
            <button class="btn btn-primary" type="submit">Filter</button>
        </div>
    </div>
</form>
<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Type</th>
                    <th>Reference</th>
                    <th>Visit / Message</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $x)
                    <tr>
                        <td>{{ $x->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <strong>{{ $x->name }}</strong><br>
                            <small>{{ $x->phone }}<br>{{ $x->email }}</small>
                        </td>
                        <td>{{ $x->type }}</td>
                        <td>{{ $x->reference }}</td>
                        <td>
                            @if($x->preferred_date)
                                <small>Date: {{ $x->preferred_date->format('Y-m-d') }} {{ $x->preferred_time }}</small><br>
                            @endif
                            {{ $x->message }}
                        </td>
                        <td>
                            <form method="post" action="{{ route('admin.inquiries.update', $x) }}">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()">
                                    @foreach(['New', 'In Progress', 'Closed'] as $s)
                                        <option @selected($x->status === $s)>{{ $s }}</option>
                                    @endforeach
                                </select>
                                <textarea name="internal_notes" placeholder="Internal notes" style="margin-top:8px;min-height:60px">{{ $x->internal_notes }}</textarea>
                                <label style="display:block;margin-top:6px;font-size:12px">
                                    <input type="checkbox" name="is_read" value="1" @checked($x->is_read) onchange="this.form.submit()"> Mark read
                                </label>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="{{ route('admin.inquiries.destroy', $x) }}" onsubmit="return confirm('Delete inquiry?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7">No inquiries yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $items->links() }}
@endsection
