@extends('layouts.app.layout')

@section('title', 'Mis Cursos')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-graduation-cap mr-3 text-blue-600"></i>
                        Mis Cursos
                    </h1>
                    <p class="text-gray-600 mt-2">Gestiona tu progreso académico y accede a tus materias</p>
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

        <!-- Estadísticas del Estudiante -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Semestres Activos</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $semestres->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-book text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Materias</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalMaterias ?? 0 }}</p>
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
                        <p class="text-2xl font-bold text-gray-900">{{ $materiasEnProgreso ?? 0 }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-trophy text-purple-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Aprobadas</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $materiasAprobadas ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información del Estudiante -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">{{ auth()->user()->estudiante->nombre }} {{ auth()->user()->estudiante->apellido_paterno }}</h2>
                    <p class="text-gray-600">Matrícula: {{ auth()->user()->estudiante->matricula }}</p>
                    <p class="text-sm text-gray-500">
                        @if(auth()->user()->estudiante->carreras->count() > 0)
                            {{ auth()->user()->estudiante->carreras->first()->nombre }}
                        @else
                            Sin carrera asignada
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Lista de Semestres -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-calendar mr-3 text-blue-600"></i>
                    Mis Semestres
                </h3>
                <p class="text-gray-600 mt-1">Accede a tus materias organizadas por semestre</p>
            </div>
            
            <div class="p-8">
                @if($semestres->isEmpty())
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-calendar-times text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No tienes semestres inscritos</h3>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto">
                            Parece que aún no estás inscrito en ningún semestre. Contacta a tu coordinador académico para proceder con tu inscripción.
                        </p>
                        <a href="{{ route('dashboard') }}" 
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <i class="fas fa-home mr-2"></i>
                            Volver al Dashboard
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($semestres as $semestre)
                            @php
                                $materiasSemestre = $semestre->materias->where('pivot.estudiante_id', auth()->user()->estudiante->id);
                                $materiasAprobadas = $materiasSemestre->where('pivot.estado', 'aprobado')->count();
                                $totalMaterias = $materiasSemestre->count();
                                $progreso = $totalMaterias > 0 ? ($materiasAprobadas / $totalMaterias) * 100 : 0;
                            @endphp
                            
                            <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-all duration-300 hover:scale-105">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-calendar-alt text-white"></i>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $totalMaterias }} materias
                                    </span>
                                </div>
                                
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $semestre->nombre }}</h4>
                                
                                <div class="mb-4">
                                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                                        <span>Progreso</span>
                                        <span>{{ number_format($progreso, 1) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full transition-all duration-300" 
                                             style="width: {{ $progreso }}%"></div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
                                    <span>Aprobadas: {{ $materiasAprobadas }}</span>
                                    <span>Pendientes: {{ $totalMaterias - $materiasAprobadas }}</span>
                                </div>
                                
                                <a href="{{ route('estudiante.semestre', $semestre->id) }}" 
                                   class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                    <i class="fas fa-eye mr-2"></i>
                                    Ver Materias
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Acciones Rápidas -->
        <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-bolt mr-2 text-yellow-500"></i>
                Acciones Rápidas
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('estudiante.notas') }}" 
                   class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-indigo-50 rounded-lg border border-purple-200 hover:from-purple-100 hover:to-indigo-100 transition-all duration-200">
                    <i class="fas fa-chart-bar text-purple-600 mr-3"></i>
                    <span class="font-medium text-gray-900">Ver Notas</span>
                </a>
                
                <a href="{{ route('inscripcion.historial') }}" 
                   class="flex items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg border border-green-200 hover:from-green-100 hover:to-emerald-100 transition-all duration-200">
                    <i class="fas fa-history text-green-600 mr-3"></i>
                    <span class="font-medium text-gray-900">Historial</span>
                </a>
                
                <a href="{{ route('reinscripcion.index') }}" 
                   class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-lg border border-blue-200 hover:from-blue-100 hover:to-cyan-100 transition-all duration-200">
                    <i class="fas fa-plus-circle text-blue-600 mr-3"></i>
                    <span class="font-medium text-gray-900">Reinscripción</span>
                </a>
                
                <a href="{{ route('profile.show') }}" 
                   class="flex items-center p-4 bg-gradient-to-r from-orange-50 to-red-50 rounded-lg border border-orange-200 hover:from-orange-100 hover:to-red-100 transition-all duration-200">
                    <i class="fas fa-user-cog text-orange-600 mr-3"></i>
                    <span class="font-medium text-gray-900">Mi Perfil</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 