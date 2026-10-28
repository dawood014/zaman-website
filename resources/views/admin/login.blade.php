<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login | Zaman Build Tech</title>
    <link rel="stylesheet" href="{{ asset('assets/admin.css') }}">
</head>
<body>
<div class="login-page">
    <div class="login-visual" style="background-image: linear-gradient(120deg,rgba(0,0,0,.82),rgba(0,0,0,.35)), url('{{ asset('assets/logo.png') }}');">
        <div>
            <div class="kicker">Website Administration</div>
            <h1>Manage Zaman Build Tech & Real Estate</h1>
            <p>Control website sections, projects, properties, services, team, content, inquiries and contact information from one admin area.</p>
        </div>
    </div>
    <div class="login-panel">
        <form class="login-box" method="post" action="{{ route('admin.login.post', absolute: false) }}">
            @csrf
            <img src="{{ asset('assets/logo.png') }}" alt="Zaman Build Tech" onerror="this.style.display='none'">
            <h2>Admin Login</h2>
            <p>Sign in to manage the website.</p>
            @if($errors->any())
                <div style="color:#b42318;font-size:13px;margin-bottom:12px">{{ $errors->first() }}</div>
            @endif
            <div class="field">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password">
            </div>
            <button class="btn btn-primary" style="width:100%" type="submit">Login to Admin</button>
        </form>
    </div>
</div>
</body>
</html>
