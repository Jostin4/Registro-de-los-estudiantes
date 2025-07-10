@extends('layouts.app.layout')

@section('title', 'Materias - ' . $semestre->nombre)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <div class="flex items-center space-x-3 mb-2">
                        <a href="{{ route('estudiante.dashboard') }}" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Volver a Mis Cursos
                        </a>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-calendar-alt mr-3 text-blue-600"></i>
                        {{ $semestre->nombre }}
                    </h1>
                    <p class="text-gray-600 mt-2">Gestiona tus materias y evaluaciones de este semestre</p>
                </div>
                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <a href="{{ route('estudiante.notas') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-indigo-600 border border-transparent rounded-lg font-semibold text-white hover:from-purple-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200 shadow-lg">
                        <i class="fas fa-chart-bar mr-2"></i>
                        Ver Mis Notas
                    </a>
                </div>
            </div>
        </div>

        <!-- Estadísticas del Semestre -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-book text-blue-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Materias</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $materias->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Aprobadas</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $materias->where('pivot.estado', 'aprobado')->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">En Progreso</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $materias->where('pivot.estado', 'inscrito')->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Promedio</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($promedioSemestre ?? 0, 1) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtros y Búsqueda -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-filter mr-2 text-blue-600"></i>
                    Filtros y Búsqueda
                </h2>
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" 
                               id="busquedaMateria" 
                               class="pl-10 pr-4 py-2 w-full sm:w-64 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                               placeholder="Buscar materia...">
                    </div>
                    <select id="estadoFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Todos los estados</option>
                        <option value="inscrito">Inscrito</option>
                        <option value="aprobado">Aprobado</option>
                        <option value="reprobado">Reprobado</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Lista de Materias -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-book-open mr-3 text-blue-600"></i>
                    Mis Materias
                </h3>
                <p class="text-gray-600 mt-1">Accede a tus evaluaciones y notas de cada materia</p>
            </div>
            
            <div class="p-8">
                @if($materias->isEmpty())
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-book-open text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No tienes materias inscritas</h3>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto">
                            No estás inscrito en ninguna materia de este semestre. Contacta a tu coordinador académico para proceder con tu inscripción.
                        </p>
                        <a href="{{ route('estudiante.dashboard') }}" 
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Volver a Mis Cursos
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="listaMaterias">
                        @foreach($materias as $materia)
                            @php
                                $estado = $materia->pivot->estado ?? 'inscrito';
                                $estadoColors = [
                                    'inscrito' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'icon' => 'fas fa-clock'],
                                    'aprobado' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'icon' => 'fas fa-check-circle'],
                                    'reprobado' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'icon' => 'fas fa-times-circle'],
                                    'cursando' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'icon' => 'fas fa-play-circle']
                                ];
                                $color = $estadoColors[$estado] ?? $estadoColors['inscrito'];
                            @endphp
                            
                            <div class="materia-card bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-all duration-300 hover:scale-105" 
                                 data-nombre="{{ strtolower($materia->nombre) }}" 
                                 data-estado="{{ $estado }}">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-book text-white"></i>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $color['bg'] }} {{ $color['text'] }}">
                                        <i class="{{ $color['icon'] }} mr-1"></i>
                                        {{ ucfirst($estado) }}
                                    </span>
                                </div>
                                
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $materia->nombre }}</h4>
                                <p class="text-sm text-gray-600 mb-4">{{ $materia->codigo }}</p>
                                
                                <div class="mb-4">
                                    <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                                        <span>Créditos</span>
                                        <span class="font-semibold">{{ $materia->creditos ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm text-gray-600">
                                        <span>Horas</span>
                                        <span class="font-semibold">{{ ($materia->horas_teoricas ?? 0) + ($materia->horas_practicas ?? 0) }}h</span>
                                    </div>
                                </div>
                                
                                <div class="flex space-x-2">
                                    <a href="{{ route('estudiante.materia', [$semestre->id, $materia->id]) }}" 
                                       class="flex-1 inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                        <i class="fas fa-eye mr-2"></i>
                                        Ver Evaluaciones
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const busquedaInput = document.getElementById('busquedaMateria');
    const estadoFilter = document.getElementById('estadoFilter');
    const materiaCards = document.querySelectorAll('.materia-card');

    function filtrarMaterias() {
        const busqueda = busquedaInput.value.toLowerCase();
        const estado = estadoFilter.value;

        materiaCards.forEach(card => {
            const nombre = card.getAttribute('data-nombre');
            const cardEstado = card.getAttribute('data-estado');
            
            const coincideBusqueda = nombre.includes(busqueda);
            const coincideEstado = !estado || cardEstado === estado;
            
            if (coincideBusqueda && coincideEstado) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    busquedaInput.addEventListener('input', filtrarMaterias);
    estadoFilter.addEventListener('change', filtrarMaterias);
});
</script>
@endpush
@endsection 