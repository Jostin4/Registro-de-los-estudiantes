@extends('layouts.app.layout')

@section('page-title', 'Detalles del Profesor')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-tie text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $profesor->nombre }} {{ $profesor->apellido }}</h1>
                        <p class="text-lg text-gray-600">Profesor del Sistema Académico</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('profesores.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        <i class="fas fa-arrow-left mr-2"></i>Volver
                    </a>
                    <a href="{{ route('profesores.edit', $profesor->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <i class="fas fa-edit mr-2"></i>Editar
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Información principal -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Información personal -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Información Personal</h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Nombre completo</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $profesor->nombre }} {{ $profesor->apellido }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Nombre de usuario</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $profesor->user->name }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Correo electrónico</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $profesor->user->email }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Rol</label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                    {{ ucfirst($profesor->user->role) }}
                                </span>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500">ID del profesor</label>
                                <p class="mt-1 text-sm text-gray-900">#{{ $profesor->id }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Fecha de registro</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $profesor->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Materias asignadas -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-medium text-gray-900">Materias Asignadas</h2>
                            <a href="{{ route('profesores.materias', $profesor->id) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                <i class="fas fa-cog mr-1"></i>Gestionar
                            </a>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        @if($profesor->materias->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($profesor->materias as $materia)
                                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors duration-200">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h3 class="text-sm font-medium text-gray-900">{{ $materia->nombre }}</h3>
                                                <p class="text-xs text-gray-500 mt-1">Código: {{ $materia->codigo }}</p>
                                                <p class="text-xs text-gray-500">Créditos: {{ $materia->creditos }}</p>
                                            </div>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $materia->estado === 'Activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $materia->estado }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-book-open text-gray-400 text-4xl mb-4"></i>
                                <p class="text-gray-500">No hay materias asignadas</p>
                                <a href="{{ route('profesores.materias', $profesor->id) }}" class="mt-2 inline-flex items-center text-indigo-600 hover:text-indigo-800">
                                    <i class="fas fa-plus mr-1"></i>Asignar materias
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Estadísticas</h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="text-center">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-book text-blue-600"></i>
                                </div>
                                <p class="text-2xl font-bold text-gray-900">{{ $profesor->materias->count() }}</p>
                                <p class="text-sm text-gray-500">Materias asignadas</p>
                            </div>
                            
                            <div class="text-center">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-users text-green-600"></i>
                                </div>
                                <p class="text-2xl font-bold text-gray-900">0</p>
                                <p class="text-sm text-gray-500">Estudiantes</p>
                            </div>
                            
                            <div class="text-center">
                                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-chart-line text-purple-600"></i>
                                </div>
                                <p class="text-2xl font-bold text-gray-900">0</p>
                                <p class="text-sm text-gray-500">Evaluaciones</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Estado de la cuenta -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Estado de la Cuenta</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Estado</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Activo
                                </span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Último acceso</span>
                                <span class="text-sm text-gray-900">{{ $profesor->user->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Verificación de email</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $profesor->user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $profesor->user->email_verified_at ? 'Verificado' : 'Pendiente' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acciones rápidas -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Acciones Rápidas</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('profesores.edit', $profesor->id) }}" class="flex items-center text-sm text-indigo-600 hover:text-indigo-800">
                                <i class="fas fa-edit mr-2"></i>
                                Editar información
                            </a>
                            <a href="{{ route('profesores.materias', $profesor->id) }}" class="flex items-center text-sm text-indigo-600 hover:text-indigo-800">
                                <i class="fas fa-book mr-2"></i>
                                Gestionar materias
                            </a>
                            <a href="#" class="flex items-center text-sm text-gray-600 hover:text-gray-800">
                                <i class="fas fa-chart-bar mr-2"></i>
                                Ver estadísticas
                            </a>
                            <a href="#" class="flex items-center text-sm text-gray-600 hover:text-gray-800">
                                <i class="fas fa-history mr-2"></i>
                                Historial de actividad
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Información adicional -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Información Adicional</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Creado el</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $profesor->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Última actualización</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $profesor->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 