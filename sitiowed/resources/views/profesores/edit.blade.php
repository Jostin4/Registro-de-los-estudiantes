@extends('layouts.app.layout')

@section('page-title', 'Editar Profesor')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Editar Profesor</h1>
                    <p class="mt-2 text-gray-600">Actualiza la información del profesor {{ $profesor->nombre }} {{ $profesor->apellido }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('profesores.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        <i class="fas fa-arrow-left mr-2"></i>Volver
                    </a>
                    <a href="{{ route('profesores.materias', $profesor->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <i class="fas fa-book mr-2"></i>Gestionar Materias
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Formulario principal -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Información del Profesor</h2>
                        <p class="mt-1 text-sm text-gray-600">Actualiza los datos personales y de contacto</p>
                    </div>
                    
                    <div class="p-6">
                        <form action="{{ route('profesores.update', $profesor->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Información de usuario -->
                                <div class="md:col-span-2">
                                    <h3 class="text-md font-medium text-gray-900 mb-4">Información de Usuario</h3>
                                </div>
                                
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre de usuario</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $profesor->user->name) }}" required
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $profesor->user->email) }}" required
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Información personal -->
                                <div class="md:col-span-2">
                                    <h3 class="text-md font-medium text-gray-900 mb-4 mt-6">Información Personal</h3>
                                </div>
                                
                                <div>
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $profesor->nombre) }}" required
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    @error('nombre')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                                    <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $profesor->apellido) }}" required
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    @error('apellido')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mt-8 flex justify-end space-x-3">
                                <a href="{{ route('profesores.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                    Cancelar
                                </a>
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <i class="fas fa-save mr-2"></i>Actualizar Profesor
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Cambiar contraseña -->
                <div class="mt-6 bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Cambiar Contraseña</h2>
                        <p class="mt-1 text-sm text-gray-600">Actualiza la contraseña del profesor</p>
                    </div>
                    
                    <div class="p-6">
                        <form action="{{ route('profesores.change-password', $profesor->id) }}" method="POST">
                            @csrf
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700">Contraseña actual</label>
                                    <input type="password" name="current_password" id="current_password" required
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                
                                <div>
                                    <label for="new_password" class="block text-sm font-medium text-gray-700">Nueva contraseña</label>
                                    <input type="password" name="password" id="new_password" required
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <p class="mt-1 text-xs text-gray-500">Mínimo 8 caracteres</p>
                                </div>
                                
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar nueva contraseña</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" required
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                    <i class="fas fa-key mr-2"></i>Cambiar Contraseña
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar con información adicional -->
            <div class="lg:col-span-1">
                <!-- Información del profesor -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Información del Profesor</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user-tie text-indigo-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">{{ $profesor->nombre }} {{ $profesor->apellido }}</p>
                                    <p class="text-sm text-gray-500">{{ $profesor->user->email }}</p>
                                </div>
                            </div>
                            
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">ID del profesor</span>
                                    <span class="text-sm font-medium text-gray-900">#{{ $profesor->id }}</span>
                                </div>
                            </div>
                            
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Estado</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Activo
                                    </span>
                                </div>
                            </div>
                            
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Materias asignadas</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $profesor->materias->count() }}</span>
                                </div>
                            </div>
                            
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Fecha de registro</span>
                                    <span class="text-sm text-gray-900">{{ $profesor->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acciones rápidas -->
                <div class="mt-6 bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Acciones Rápidas</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('profesores.materias', $profesor->id) }}" class="flex items-center text-sm text-indigo-600 hover:text-indigo-800">
                                <i class="fas fa-book mr-2"></i>
                                Gestionar Materias
                            </a>
                            <a href="#" class="flex items-center text-sm text-gray-600 hover:text-gray-800">
                                <i class="fas fa-chart-bar mr-2"></i>
                                Ver Estadísticas
                            </a>
                            <a href="#" class="flex items-center text-sm text-gray-600 hover:text-gray-800">
                                <i class="fas fa-history mr-2"></i>
                                Historial de Actividad
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Materias asignadas -->
                @if($profesor->materias->count() > 0)
                <div class="mt-6 bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Materias Asignadas</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-2">
                            @foreach($profesor->materias->take(5) as $materia)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-900">{{ $materia->nombre }}</span>
                                <span class="text-xs text-gray-500">{{ $materia->codigo }}</span>
                            </div>
                            @endforeach
                            
                            @if($profesor->materias->count() > 5)
                            <div class="text-center pt-2">
                                <span class="text-xs text-gray-500">Y {{ $profesor->materias->count() - 5 }} más...</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 