<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-white p-6 shadow">
        <div class="max-w-7xl mx-auto">
            @auth
                <a href="{{ route('home') }}" class="text-gray-600 mr-4">Home</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-600">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-600 mr-4">Login</a>
                <a href="{{ route('register') }}" class="text-gray-600">Register</a>
            @endauth
        </div>
    </nav>
    <main class="max-w-7xl mx-auto py-6">
        @yield('content')
    </main>
</body>
</html>