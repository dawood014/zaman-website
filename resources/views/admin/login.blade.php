<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('assets/admin.css') }}">
</head>
<body>
<div class="login-shell">
    <div class="login-card">
        <img src="{{ asset('assets/logo.png') }}" alt="Zaman Build Tech" style="max-width:180px" onerror="this.style.display='none'">
        <h1>Admin Login</h1>
        <p>Zaman Build Tech & Real Estate CMS</p>
        @if($errors->any())
            <div class="notice show">{{ $errors->first() }}</div>
        @endif
        <form method="post" action="{{ route('admin.login.post', absolute: false) }}">
            @csrf
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', 'admin@zamanbuildtech.com') }}" required autocomplete="username">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
            </div>
            <label><input type="checkbox" name="remember"> Remember me</label>
            <button class="btn btn-primary" style="width:100%;margin-top:18px" type="submit">Login</button>
        </form>
        <p style="margin-top:16px;font-size:13px;opacity:.75">Use the same address you opened this page with (e.g. <strong>http://zamanbuild.test</strong>).</p>
    </div>
</div>
</body>
</html>
