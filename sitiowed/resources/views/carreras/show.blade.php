{{-- resources/views/carreras/show.blade.php --}}
@extends('layouts.app.layout') {{-- Extiende el layout principal del dashboard --}}

@section('title', 'Detalles de la Carrera') {{-- Título específico para esta página --}}

@section('navbar')
    @include('components.navbar') {{-- Incluye el componente de la barra de navegación --}}
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold text-gray-800">Detalles de la Carrera</h1>
            <a href="{{ route('carreras.index') }}" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md font-semibold hover:bg-gray-300 transition-colors duration-200">
                Volver al Listado
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-inner p-5 mb-6 border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200">Información General</h2>
            <dl class="divide-y divide-gray-200">
                <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50 rounded-t-md">
                    <dt class="text-sm font-medium text-gray-500">ID de Carrera</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $carrera->id }}
                    </dd>
                </div>
                <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-white rounded-b-md">
                    <dt class="text-sm font-medium text-gray-500">Nombre de la Carrera</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $carrera->nombre }}
                    </dd>
                </div>
                {{-- Aquí puedes añadir más detalles de la carrera si tu modelo los tuviera --}}
            </dl>
        </div>

        <div class="bg-white rounded-lg shadow-inner p-5 mb-6 border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200">Semestres Asociados</h2>
            <div class="mb-4 flex justify-end">
                <a href="{{ route('associateSemestresForm', $carrera->id) }}" class="bg-blue-600 text-white py-2 px-4 rounded-md font-semibold hover:bg-blue-700 transition-colors duration-200">
                    Gestionar Semestres
                </a>
            </div>

            @if($carrera->semestres->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($carrera->semestres as $semestre)
                        <div class="bg-indigo-50 p-4 rounded-lg flex items-center justify-between shadow-sm border border-indigo-200">
                            <span class="text-indigo-800 font-medium">{{ $semestre->nombre ?? 'Semestre sin nombre' }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">No hay semestres asociados a esta carrera.</p>
            @endif
        </div>
        {{-- Lista de estudiantes inscritos --}}
<div class="bg-white rounded-lg shadow-inner p-5 mb-6 border border-gray-200">
    <h2 class="text-2xl font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200">Estudiantes Inscritos</h2>

    @if($carrera->estudiantes->count() > 0)
        <ul class="divide-y divide-gray-200 mb-4">
            @foreach($carrera->estudiantes as $estudiante)
                <li class="py-2 flex justify-between items-center">
                    <span>{{ $estudiante->nombre }}</span>
                    <a href="{{ route('estudiantes.show', $estudiante->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">Ver Detalles</a>
                    {{-- Puedes añadir más acciones aquí, como ver perfil o eliminar de la carrera --}}
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-600">No hay estudiantes inscritos en esta carrera.</p>
    @endif

    {{-- Formulario para añadir estudiantes --}}
    <form action="{{ route('carreras.addEstudiante', $carrera->id) }}" method="POST" class="flex items-center gap-2 mt-4">
        @csrf
        <select name="estudiante_id" class="border rounded px-2 py-1" required>
            <option value="">Selecciona un estudiante</option>
            @foreach($estudiantesDisponibles as $estudiante)
                <option value="{{ $estudiante->id }}">{{ $estudiante->nombre }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-green-600 text-white py-1 px-3 rounded hover:bg-green-700 transition">Añadir</button>
    </form>
</div>

        <div class="mt-6 flex justify-end gap-2">
            <a href="{{ route('carreras.edit', $carrera->id) }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md font-semibold hover:bg-indigo-700 transition-colors duration-200">
                <i class="bi bi-pencil-square"></i>
            </a>
            <form action="{{ route('carreras.destroy', $carrera->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta carrera?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md font-semibold hover:bg-red-700 transition-colors duration-200">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    @include('components.footer') {{-- Incluye el componente del pie de página --}}
@endsection
