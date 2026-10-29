@extends('layouts.admin')

@section('title', $cfg['label'])

@section('content')
<div class="topbar">
    <div>
        <div class="kicker">Content Management</div>
        <h1>{{ $cfg['label'] }}</h1>
    </div>
    <div class="top-actions">
        <a class="btn btn-primary" href="{{ route('admin.module.create', $module) }}">+ Add New</a>
    </div>
</div>

@if($module === 'home-sections')
    <p class="help" style="margin:0 0 16px">Edit the homepage <strong>Who We Are</strong> section (recommended slug: <code>who-we-are</code>).</p>
@endif

<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    @if($module === 'achievements')
                        <th>Label</th>
                        <th>Value</th>
                    @elseif($module === 'why-choose')
                        <th>Reason Title</th>
                        <th>Icon</th>
                    @else
                        <th>Title</th>
                    @endif
                    <th>Status</th>
                    <th>Order</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>
                            @if($module === 'achievements')
                                <strong>{{ $item->value('label', $item->title) }}</strong><br>
                                <small>{{ $item->slug }}</small>
                            @elseif($module === 'why-choose')
                                <strong>{{ $item->title ?: '—' }}</strong><br>
                                <small>{{ $item->slug }}</small>
                            @else
                                <strong>{{ $item->title }}</strong><br>
                                <small>{{ $item->slug }}</small>
                            @endif
                        </td>
                        @if($module === 'achievements')
                            <td>{{ $item->value('value', '—') }}</td>
                        @elseif($module === 'why-choose')
                            <td>{{ $item->value('icon', '—') }}</td>
                        @endif
                        <td><span class="badge green">{{ $item->status }}</span></td>
                        <td>{{ $item->sort_order }}</td>
                        <td>{{ $item->updated_at->format('d M Y') }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn btn-light btn-sm" href="{{ route('admin.module.edit', [$module, $item]) }}">Edit</a>
                                <form method="post" action="{{ route('admin.module.destroy', [$module, $item]) }}" onsubmit="return confirm('Delete this item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="{{ in_array($module, ['achievements', 'why-choose'], true) ? 6 : 5 }}">No records yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{ $items->links() }}
@endsection
