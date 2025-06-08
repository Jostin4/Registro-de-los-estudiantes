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

        <div class="border-t border-gray-200 pt-4">
            <dl>
                <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-md">
                    <dt class="text-sm font-medium text-gray-500">ID de Carrera</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $carrera->id }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-md">
                    <dt class="text-sm font-medium text-gray-500">Nombre de la Carrera</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $carrera->nombre }}
                    </dd>
                </div>
                {{-- Aquí puedes añadir más detalles de la carrera si tu modelo los tuviera --}}
            </dl>
        </div>
            <div class="mt-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Semestres Asociados</h2>
                <div class="mb-4">
                    <a href="{{ route('associateSemestresForm', $carrera->id) }}" class="bg-blue-600 text-white py-2 px-4 rounded-md font-semibold hover:bg-blue-700 transition-colors duration-200">
                        Gestionar Semestres
                    </a>
                </div>
            
                @if($carrera->semestres->count() > 0)
                    <ul class="divide-y divide-gray-200 bg-white rounded-lg shadow-md">
                        @foreach($carrera->semestres as $semestre)
                            <li class="px-6 py-4 flex justify-between items-center">
                                <span class="text-gray-900">{{ $semestre->nombre ?? 'Semestre sin nombre' }}</span>
                                <a href="#" class="text-indigo-600 hover:text-indigo-900 text-sm">Ver Detalles</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600">No hay semestres asociados a esta carrera.</p>
                @endif
            </div>
        </div>


        <div class="mt-6 flex justify-end">
            <a href="{{ route('carreras.edit', $carrera->id) }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md font-semibold hover:bg-indigo-700 transition-colors duration-200 mr-2">
                <i class="bi bi-pencil-square"></i>
            </a>
            {{-- Formulario para eliminar (requiere un método DELETE) --}}
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
