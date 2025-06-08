{{-- resources/views/dashboard/index.blade.php --}}
@extends('layouts.app.layout') {{-- Extiende el layout principal del dashboard --}}

@section('title', 'Panel de Control') {{-- Título específico para esta página --}}

@section('navbar')
    @include('components.navbar') {{-- Incluye el componente de la barra de navegación --}}
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md mb-6 text-center">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-4">¡Bienvenido a tu Panel de Control!</h1>
        <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
            Aquí puedes gestionar eficientemente las **carreras** y los **estudiantes** de tu institución.
        </p>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-6 mt-8">
            <a href="{{ route('carreras.index') }}" class="flex items-center justify-center w-full sm:w-auto px-8 py-4 bg-indigo-600 text-white rounded-lg font-semibold text-xl hover:bg-indigo-700 transition-colors duration-200 shadow-lg">
                <svg class="w-7 h-7 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                Ver Carreras
            </a>
            <a href="{{ route('estudiantes.index') }}" class="flex items-center justify-center w-full sm:w-auto px-8 py-4 bg-teal-600 text-white rounded-lg font-semibold text-xl hover:bg-teal-700 transition-colors duration-200 shadow-lg">
                <svg class="w-7 h-7 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                Ver Estudiantes
            </a>
        </div>
    </div>
@endsection

@section('footer')
    @include('components.footer') {{-- Incluye el componente del pie de página --}}
@endsection
