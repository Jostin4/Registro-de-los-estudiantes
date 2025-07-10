@extends('layouts.app.layout')

@section('page-title', 'Mi Perfil')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Mi Perfil</h1>
            <p class="mt-2 text-gray-600">Gestiona tu información personal y preferencias</p>
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
            <!-- Información del perfil -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Información Personal</h2>
                        <p class="mt-1 text-sm text-gray-600">Actualiza tu información personal</p>
                    </div>
                    
                    <div class="p-6">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre completo</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                
                                <div>
                                    <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                                    <input type="text" id="role" value="{{ ucfirst($user->role) }}" 
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-50" readonly>
                                </div>
                                
                                <div>
                                    <label for="created_at" class="block text-sm font-medium text-gray-700">Fecha de registro</label>
                                    <input type="text" id="created_at" value="{{ $user->created_at->format('d/m/Y H:i') }}" 
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-50" readonly>
                                </div>
                            </div>
                            
                            <div class="mt-6 flex justify-end">
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Actualizar Perfil
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar con información adicional -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Información de la cuenta</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-indigo-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                </div>
                            </div>
                            
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Estado de la cuenta</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Activa
                                    </span>
                                </div>
                            </div>
                            
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Último acceso</span>
                                    <span class="text-sm text-gray-900">{{ $user->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acciones rápidas -->
                <div class="mt-6 bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Acciones rápidas</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('profile.settings') }}" class="flex items-center text-sm text-indigo-600 hover:text-indigo-800">
                                <i class="fas fa-cog mr-2"></i>
                                Configuración
                            </a>
                            <a href="#" class="flex items-center text-sm text-gray-600 hover:text-gray-800">
                                <i class="fas fa-shield-alt mr-2"></i>
                                Seguridad
                            </a>
                            <a href="#" class="flex items-center text-sm text-gray-600 hover:text-gray-800">
                                <i class="fas fa-history mr-2"></i>
                                Historial de actividad
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 