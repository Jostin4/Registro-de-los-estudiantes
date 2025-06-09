{{-- resources/views/carreras/edit.blade.php --}}
@extends('layouts.app.layout') {{-- Extiende el layout principal del dashboard --}}

@section('title', 'Editar Carrera') {{-- Título específico para esta página --}}

@section('navbar')
    @include('components.navbar') {{-- Incluye el componente de la barra de navegación --}}
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold text-gray-800">Editar Carrera: {{ $carrera->nombre }}</h1>
            <a href="{{ route('carreras.index') }}" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md font-semibold hover:bg-gray-300 transition-colors duration-200">
                Volver al Listado
            </a>
        </div>

        <form action="{{ route('carreras.update', $carrera->id) }}" method="POST" class="space-y-6">
            @csrf {{-- Directiva CSRF de Laravel para seguridad --}}
            @method('PUT') {{-- Usa el método PUT para las actualizaciones --}}

            <div>
                <label for="nombre" class="block text-gray-700 text-sm font-semibold mb-2">Nombre de la Carrera</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $carrera->nombre) }}" placeholder="Ej: Ingeniería de Software" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-400 text-gray-800">
                @error('nombre')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-indigo-600 text-white py-2 px-6 rounded-md font-semibold text-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Actualizar Carrera
                </button>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    @include('components.footer') {{-- Incluye el componente del pie de página --}}
@endsection
