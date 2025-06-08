{{-- resources/views/estudiantes/show.blade.php --}}
@extends('layouts.app.layout') {{-- Extiende el layout principal del dashboard --}}

@section('title', 'Detalles del Estudiante') {{-- Título específico para esta página --}}

@section('navbar')
    @include('components.navbar') {{-- Incluye el componente de la barra de navegación --}}
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold text-gray-800">Detalles del Estudiante</h1>
            <a href="{{ route('estudiantes.index') }}" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md font-semibold hover:bg-gray-300 transition-colors duration-200">
                Volver al Listado
            </a>
        </div>

        <div class="border-t border-gray-200 pt-4">
            <dl>
                <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-md">
                    <dt class="text-sm font-medium text-gray-500">ID</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $estudiante->id }}</dd>
                </div>
                <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-md">
                    <dt class="text-sm font-medium text-gray-500">Nombre Completo</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $estudiante->nombre }} {{ $estudiante->segundo_nombre }} {{ $estudiante->apellido_paterno }} {{ $estudiante->apellido_materno }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-md">
                    <dt class="text-sm font-medium text-gray-500">Fecha de Nacimiento</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ \Carbon\Carbon::parse($estudiante->fecha_nacimiento)->format('d/m/Y') }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-md">
                    <dt class="text-sm font-medium text-gray-500">Correo Electrónico</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $estudiante->correo }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-md">
                    <dt class="text-sm font-medium text-gray-500">Teléfono</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $estudiante->telefono ?? 'N/A' }}</dd>
                </div>
                <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-md">
                    <dt class="text-sm font-medium text-gray-500">Género</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $estudiante->genero }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-md">
                    <dt class="text-sm font-medium text-gray-500">Estado</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $estudiante->estado }}</dd>
                </div>
                <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-md">
                    <dt class="text-sm font-medium text-gray-500">Matrícula</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $estudiante->matricula }}</dd>
                </div>
            </dl>
        </div>
        <div class="mt-6 flex justify-end">
            <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md font-semibold hover:bg-indigo-700 transition-colors duration-200 mr-2">
                <i class="bi bi-pencil-square"></i>
            </a>
            {{-- Formulario para eliminar (requiere un método DELETE) --}}
            <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este estudiante?');">
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
