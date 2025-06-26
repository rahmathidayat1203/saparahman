@extends('layouts.auth')

@section('content')
<style>

    body {
        background: linear-gradient(to bottom right, #53c5d8, #057f9b);
        background-image: url('{{ asset('assets/images/bglogin.jpg') }}');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
    }

    .auth-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
    }

    .login-card {
        background: white;
        border-radius: 25px;
        padding: 40px 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 450px;
    }

    .header-logo-title {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        gap: 15px;
    }

    .header-logo-title img {
        width: 60px;
        height: 60px;
        object-fit: contain;
    }

    .header-logo-title .title {
        font-size: 1.4rem;
        font-weight: bold;
        line-height: 1.2;
    }

    .title span.sapa {
        color: #4E9F3D;
        display: block;
    }

    .title span.rahman {
        color: #02542D;
        display: block;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        width: 100%;
        box-sizing: border-box;
        border-radius: 12px;
        background: #f2f2f2;
        padding: 12px 15px;
        font-size: 1rem;
        border: 1px solid transparent;
    }

    .form-control:focus {
        border-color: #80bdff;
        outline: none;
        background-color: #e9f6fb;
    }

    .btn-login {
        width: 100%;
        border-radius: 12px;
        padding: 12px 15px;
        font-size: 1rem;
        background-color: #f7a400;
        color: white;
        font-weight: bold;
        border: none;
        transition: background 0.3s;
    }

    .btn-login:hover {
        background-color: #e69400;
    }

    .invalid-feedback {
        display: block;
        font-size: 0.875rem;
        color: #dc3545;
        margin-top: 5px;
    }
</style>

<div class="auth-wrapper">
    <div class="login-card">
        <div class="header-logo-title">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
            <div class="title">
                <span class="sapa">SAPA</span>
                <span class="rahman">RAHMAN</span>
            </div>
        </div>

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="form-group">
                <input id="no_wa" type="text"
                       class="form-control @error('no_wa') is-invalid @enderror"
                       name="no_wa" value="{{ old('no_wa') }}" required autofocus
                       placeholder="Username">

                @error('no_wa')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required
                       placeholder="Password">

                @error('password')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-login">Login</button>
        </form>
    </div>
</div>
@endsection
