@extends('auth.app')

@section('content')
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="no_wa" class="block text-sm font-medium text-gray-700">Nomor WhatsApp</label>
                <input id="no_wa" type="text" name="no_wa" value="{{ old('no_wa') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="08xxxxxxxxxx">
                @error('no_wa')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                    Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">Daftar</button>
        </form>
    </div>
@endsection
