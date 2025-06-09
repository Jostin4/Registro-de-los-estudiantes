{{-- Este archivo (ej: resources/views/auth/login.blade.php) extiende el layout base de autenticación --}}
@extends('layouts.auth.layout') {{-- Asegúrate de que 'layouts.auth' apunte al archivo del layout base --}}

@section('title', 'Iniciar Sesión') {{-- Título específico para esta página --}}

@section('form_content')
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Bienvenido de nuevo</h2>
    <form class="space-y-4" action="{{ route('login') }}" method="POST">
        @csrf {{-- Directiva CSRF de Laravel para seguridad --}}
        <div>
            <label for="login-email" class="block text-gray-700 text-sm font-semibold mb-2">Correo Electrónico</label>
            <input type="email" id="login-email" name="email" placeholder="tu@ejemplo.com" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-400 text-gray-800">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="login-password" class="block text-gray-700 text-sm font-semibold mb-2">Contraseña</label>
            <input type="password" id="login-password" name="password" placeholder="••••••••" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-400 text-gray-800">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center text-gray-700">
                <input type="checkbox" name="remember" class="form-checkbox text-indigo-600 rounded-sm mr-2 focus:ring-indigo-500">
                <span>Recordarme</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">¿Olvidaste tu contraseña?</a>
            @endif
        </div>
        <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md font-semibold text-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Iniciar Sesión
        </button>
    </form>
@endsection
