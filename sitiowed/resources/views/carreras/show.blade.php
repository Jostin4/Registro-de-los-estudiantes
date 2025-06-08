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

        {{-- Sección de Información General --}}
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

        {{-- Sección de Semestres Asociados --}}
        <div class="bg-white rounded-lg shadow-inner p-5 mb-6 border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200">Semestres Asociados</h2>
            <div class="mb-4 flex justify-end">
                <a href="{{ route('associateSemestres', $carrera->id) }}" class="bg-blue-600 text-white py-2 px-4 rounded-md font-semibold hover:bg-blue-700 transition-colors duration-200">
                    Gestionar Semestres
                </a>
            </div>

            @if($carrera->semestres->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($carrera->semestres as $semestre)
                        <div class="bg-indigo-50 p-4 rounded-lg flex items-center justify-between shadow-sm border border-indigo-200">
                            <span class="text-indigo-800 font-medium">{{ $semestre->nombre ?? 'Semestre sin nombre' }}</span>
                            <a href="#" class="text-indigo-600 hover:text-indigo-900 text-sm">Ver Detalles</a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">No hay semestres asociados a esta carrera.</p>
            @endif
        </div>

        {{-- Sección de Estudiantes Inscritos (AHORA EN TABLA) --}}
        <div class="bg-white rounded-lg shadow-inner p-5 mb-6 border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200">Estudiantes Inscritos</h2>

            @if($carrera->estudiantes->count() > 0)
                <div class="overflow-x-auto mb-4">
                    <table class="min-w-full bg-white rounded-lg overflow-hidden border border-gray-200">
                        <thead class="bg-gray-100 border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nombre</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Correo</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Matrícula</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($carrera->estudiantes as $estudiante)
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $estudiante->id }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $estudiante->nombre }} {{ $estudiante->apellido_paterno }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $estudiante->correo }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $estudiante->matricula }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium flex gap-2">
                                        <a href="{{ route('estudiantes.show', $estudiante->id) }}" class="bg-green-600 text-white py-1 px-3 rounded-md text-xs font-semibold hover:bg-green-700 transition-colors duration-200">
                                            Ver
                                        </a>
                                        <form action="{{ route('carreras.removeEstudiante', [$carrera->id, $estudiante->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres remover a este estudiante de la carrera?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white py-1 px-3 rounded-md text-xs font-semibold hover:bg-red-700 transition-colors duration-200">
                                                Remover
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-600">No hay estudiantes inscritos en esta carrera.</p>
            @endif

            <h3 class="text-xl font-bold text-gray-800 mb-3 pb-2 border-b border-gray-100 mt-6">Añadir Estudiante a la Carrera</h3>
            <form action="{{ route('carreras.addEstudiante', $carrera->id) }}" method="POST" class="flex flex-col sm:flex-row items-center gap-4 mt-4">
                @csrf
                <div class="flex-grow w-full sm:w-auto">
                    <label for="estudiante_id" class="sr-only">Seleccionar un estudiante</label>
                    <select name="estudiante_id" id="estudiante_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent text-gray-800" required>
                        <option value="">Selecciona un estudiante</option>
                        @foreach($estudiantesDisponibles as $estudiante)
                            <option value="{{ $estudiante->id }}">{{ $estudiante->nombre }} {{ $estudiante->apellido_paterno }}</option>
                        @endforeach
                    </select>
                    @error('estudiante_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="bg-green-600 text-white py-2 px-6 rounded-md font-semibold hover:bg-green-700 transition-colors duration-200 w-full sm:w-auto">
                    Añadir Estudiante
                </button>
            </form>
        </div>

        {{-- Sección de Botones de Acción Global --}}
        <div class="mt-6 flex justify-end gap-2">
            <a href="{{ route('carreras.edit', $carrera->id) }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md font-semibold hover:bg-indigo-700 transition-colors duration-200">
                Editar Carrera
            </a>
            <form action="{{ route('carreras.destroy', $carrera->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta carrera?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md font-semibold hover:bg-red-700 transition-colors duration-200">
                    Eliminar Carrera
                </button>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    @include('components.footer') {{-- Incluye el componente del pie de página --}}
@endsection
