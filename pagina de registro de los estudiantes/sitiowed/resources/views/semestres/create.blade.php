{{-- resources/views/semestres/create.blade.php --}}
@extends('layouts.app.layout') {{-- Extiende el layout principal del dashboard --}}

@section('title', 'Crear Nuevo Semestre') {{-- Título específico para esta página --}}

@section('navbar')
    @include('components.navbar') { {-- Incluye el componente de la barra de navegación --}}
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold text-gray-800">Crear Nuevo Semestre</h1>
            <a href="{{ route('carreras.show', $carrera->id) }}" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md font-semibold hover:bg-gray-300 transition-colors duration-200">
                Volver al Listado
            </a>
        </div>

        <form action="{{ route('semestres.store', $carrera->id) }}" method="POST" class="space-y-6">
            @csrf {{-- Directiva CSRF de Laravel para seguridad --}}

            <div>
                <input type="hidden" name="carrera_id" value="{{ $carrera->id }}">
                <label for="nombre" class="block text-gray-700 text-sm font-semibold mb-2">Nombre del Semestre</label>
                <select name="nombre" id="nombre" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-gray-800">
                    <option value="primero">Primero</option>
                    <option value="segundo">Segundo</option>
                    <option value="tercero">Tercero</option>
                    <option value="cuarto">Cuarto</option>
                    <option value="quinto">Quinto</option>
                    <option value="sexto">Sexto</option>
                </select>
                @error('nombre')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-indigo-600 text-white py-2 px-6 rounded-md font-semibold text-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Guardar Semestre
                </button>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    @include('components.footer') {{-- Incluye el componente del pie de página --}}
@endsection
