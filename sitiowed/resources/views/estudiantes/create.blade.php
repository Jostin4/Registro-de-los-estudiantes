{{-- resources/views/estudiantes/create.blade.php --}}
@extends('layouts.app.layout') {{-- Extiende el layout principal del dashboard --}}

@section('title', 'Crear Nuevo Estudiante') {{-- Título específico para esta página --}}

@section('navbar')
    @include('components.navbar') {{-- Incluye el componente de la barra de navegación --}}
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold text-gray-800">Crear Nuevo Estudiante</h1>
            <a href="{{ route('estudiantes.index') }}" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md font-semibold hover:bg-gray-300 transition-colors duration-200">
                Volver al Listado
            </a>
        </div>

        <form action="{{ route('estudiantes.store') }}" method="POST" class="space-y-6">
            @csrf {{-- Directiva CSRF de Laravel para seguridad --}}

            <!-- Fila para Nombre y Segundo Nombre -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nombre" class="block text-gray-700 text-sm font-semibold mb-2">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Primer nombre" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-400 text-gray-800">
                    @error('nombre')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="segundo_nombre" class="block text-gray-700 text-sm font-semibold mb-2">Segundo Nombre (Opcional)</label>
                    <input type="text" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre') }}" placeholder="Segundo nombre"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-400 text-gray-800">
                    @error('segundo_nombre')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Fila para Apellido Paterno y Apellido Materno -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="apellido_paterno" class="block text-gray-700 text-sm font-semibold mb-2">Apellido Paterno</label>
                    <input type="text" id="apellido_paterno" name="apellido_paterno" value="{{ old('apellido_paterno') }}" placeholder="Apellido Paterno" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-400 text-gray-800">
                    @error('apellido_paterno')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="apellido_materno" class="block text-gray-700 text-sm font-semibold mb-2">Apellido Materno</label>
                    <input type="text" id="apellido_materno" name="apellido_materno" value="{{ old('apellido_materno') }}" placeholder="Apellido Materno" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-400 text-gray-800">
                    @error('apellido_materno')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Fila para Fecha Nacimiento, Correo y Teléfono -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="fecha_nacimiento" class="block text-gray-700 text-sm font-semibold mb-2">Fecha de Nacimiento</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-gray-800">
                    @error('fecha_nacimiento')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="correo" class="block text-gray-700 text-sm font-semibold mb-2">Correo Electrónico</label>
                    <input type="email" id="correo" name="correo" value="{{ old('correo') }}" placeholder="ejemplo@dominio.com" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-400 text-gray-800">
                    @error('correo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="telefono" class="block text-gray-700 text-sm font-semibold mb-2">Teléfono</label>
                    <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}" placeholder="Ej: 555-123-4567"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-400 text-gray-800">
                    @error('telefono')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Fila para Género, Estado y Matrícula -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="genero" class="block text-gray-700 text-sm font-semibold mb-2">Género</label>
                    <select id="genero" name="genero" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-gray-800">
                        <option value="">Selecciona el género</option>
                        <option value="Masculino" {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ old('genero') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="Otro" {{ old('genero') == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('genero')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="estado" class="block text-gray-700 text-sm font-semibold mb-2">Estado</label>
                    <select id="estado" name="estado" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-gray-800">
                        <option value="">Selecciona el estado</option>
                        <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        <option value="Graduado" {{ old('estado') == 'Graduado' ? 'selected' : '' }}>Graduado</option>
                    </select>
                    @error('estado')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="matricula" class="block text-gray-700 text-sm font-semibold mb-2">Matrícula</label>
                    <input type="text" id="matricula" name="matricula" value="{{ old('matricula') }}" placeholder="Ej: 20230001" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-400 text-gray-800">
                    @error('matricula')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-indigo-600 text-white py-2 px-6 rounded-md font-semibold text-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Guardar Estudiante
                </button>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    @include('components.footer') {{-- Incluye el componente del pie de página --}}
@endsection
