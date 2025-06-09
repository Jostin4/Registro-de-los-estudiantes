{{-- Este archivo (ej: resources/views/auth/register.blade.php) extiende el layout base de autenticación --}}
@extends('layouts.auth.layout') {{-- Asegúrate de que 'layouts.auth' apunte al archivo del layout base --}}

@section('title', 'Registrarse') {{-- Título específico para esta página --}}

@section('form_content')
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Únete a nosotros</h2>
    <form class="space-y-4" action="{{ route('register') }}" method="POST">
        @csrf {{-- Directiva CSRF de Laravel para seguridad --}}
        <div>
            <label for="register-name" class="block text-gray-700 text-sm font-semibold mb-2">Nombre</label>
            <input type="text" id="register-name" name="name" placeholder="Tu nombre" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-400 text-gray-800">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="register-email" class="block text-gray-700 text-sm font-semibold mb-2">Correo Electrónico</label>
            <input type="email" id="register-email" name="email" placeholder="tu@ejemplo.com" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-400 text-gray-800">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="register-password" class="block text-gray-700 text-sm font-semibold mb-2">Contraseña</label>
            <input type="password" id="register-password" name="password" placeholder="••••••••" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-400 text-gray-800">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="register-password-confirm" class="block text-gray-700 text-sm font-semibold mb-2">Confirmar Contraseña</label>
            <input type="password" id="register-password-confirm" name="password_confirmation" placeholder="••••••••" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-400 text-gray-800">
            @error('password_confirmation')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md font-semibold text-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Registrarse
        </button>
    </form>
@endsection
