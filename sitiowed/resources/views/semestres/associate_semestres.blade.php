{{-- resources/views/carreras/associate_semestres.blade.php --}}
@extends('layouts.app.layout') {{-- Extiende el layout principal del dashboard --}}

@section('title', 'Asociar Semestres') {{-- Título específico para esta página --}}

@section('navbar')
    @include('components.navbar') {{-- Incluye el componente de la barra de navegación --}}
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold text-gray-800">Asociar Semestres a: {{ $carrera->nombre }}</h1>
            <a href="{{ route('carreras.show', $carrera->id) }}" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md font-semibold hover:bg-gray-300 transition-colors duration-200">
                Volver a Detalles de Carrera
            </a>
        </div>

        <form action="{{ route('associateSemestres', $carrera->id) }}" method="POST" class="space-y-6">
            @csrf {{-- Directiva CSRF de Laravel para seguridad --}}

            <div>
                <label for="semestres" class="block text-gray-700 text-sm font-semibold mb-2">Seleccionar Semestres</label>
                <select multiple id="semestres" name="semestres[]"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-gray-800 h-64 overflow-y-auto">
                    @foreach($semestres as $semestre)
                        <option value="{{ $semestre->id }}"
                                {{ in_array($semestre->id, $carreraSemestres) ? 'selected' : '' }}>
                            {{ $semestre->nombre }} 
                        </option>
                    @endforeach
                </select>
                <p class="text-gray-500 text-xs mt-1">Mantén presionada la tecla Ctrl (Windows) o Command (Mac) para seleccionar múltiples semestres.</p>
                @error('semestres')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('semestres.create', $carrera->id) }}" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md font-semibold hover:bg-gray-300 transition-colors duration-200 mr-4">
                    Añadir Semestre
                </a>
                <button type="submit"
                        class="bg-indigo-600 text-white py-2 px-6 rounded-md font-semibold text-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Guardar Asociación
                </button>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    @include('components.footer') {{-- Incluye el componente del pie de página --}}
@endsection
