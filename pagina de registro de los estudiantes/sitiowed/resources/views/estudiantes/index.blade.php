@extends('layouts.app.layout')

@section('title', 'Lista de Estudiantes')

@section('navbar')
    @include('components.navbar')
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold text-gray-800">Listado de Estudiantes</h1>
            <a href="{{ route('estudiantes.create') }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md font-semibold hover:bg-indigo-700 transition-colors duration-200">
                Añadir Nuevo Estudiante
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class=" bg-white rounded-lg overflow-hidden">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nombre
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Segundo Nombre
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Apellido Paterno
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Apellido Materno
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Fecha Nacimiento
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Correo
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Teléfono
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Género
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Matrícula
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($estudiantes as $estudiante)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $estudiante->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $estudiante->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $estudiante->segundo_nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $estudiante->apellido_paterno }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $estudiante->apellido_materno }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $estudiante->fecha_nacimiento }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $estudiante->correo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $estudiante->telefono }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $estudiante->genero }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $estudiante->matricula }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('estudiantes.show', $estudiante->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="text-amber-600 hover:text-amber-900 mr-4"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Estás seguro de eliminar este estudiante?')"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('footer')
    @include('components.footer') {{-- Incluye el componente del pie de página --}}
@endsection
