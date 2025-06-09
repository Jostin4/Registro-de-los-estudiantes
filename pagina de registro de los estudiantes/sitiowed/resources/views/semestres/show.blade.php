@extends('layouts.app.layout')

@section('title', 'Detalles del Semestre')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Semestre: {{ $semestre->nombre }}</h1>

        {{-- Formulario para inscribir estudiante y materia al semestre --}}
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Inscribir estudiante y materia</h2>
            <form method="POST" action="{{ route('semestres.inscribir', $semestre->id) }}" class="flex flex-col md:flex-row gap-4 items-center">
                @csrf

                <select name="estudiantes_id" class="border rounded p-2" required>
                    <option value="">Seleccione un estudiante</option>
                    @foreach($estudiantes as $estudiante)
                        <option value="{{ $estudiante->id }}">{{ $estudiante->nombre }}</option>
                    @endforeach
                </select>

                <select name="materias_id" class="border rounded p-2" required>
                    <option value="">Seleccione una materia</option>
                    @foreach($materias as $materia)
                        <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                    @endforeach
                </select>
                <a href="{{ route('materias.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Agregar Materia</a>

                {{-- Si usas secciones, agrega el select aquí (opcional) --}}
                @if(isset($secciones))
                    <select name="secciones_id" class="border rounded p-2">
                        <option value="">Seleccione una sección (opcional)</option>
                        @foreach($secciones as $seccion)
                            <option value="{{ $seccion->id }}">{{ $seccion->nombre }}</option>
                        @endforeach
                    </select>
                @endif

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Inscribir</button>
            </form>
        </div>

        {{-- Listado de inscripciones --}}
        <h2 class="text-xl font-semibold mb-2">Estudiantes y materias inscritas</h2>
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Estudiante</th>
                    <th class="py-2 px-4 border-b">Materia</th>
                    <th class="py-2 px-4 border-b">Sección</th>
                    <th class="py-2 px-4 border-b">Calificación</th>
                    <th class="py-2 px-4 border-b">Estado</th>
                    <th class="py-2 px-4 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recorridos as $recorrido)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $recorrido->estudiante->nombre ?? '' }}</td>
                        <td class="py-2 px-4 border-b">{{ $recorrido->materia->nombre ?? '' }}</td>
                        <td class="py-2 px-4 border-b">
                            {{ $recorrido->seccion->nombre ?? '-' }}
                        </td>
                        <td class="py-2 px-4 border-b">{{ $recorrido->calificacion ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $recorrido->estado ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">
                            <form method="POST" action="{{ route('recorridos.destroy', $recorrido->id) }}" onsubmit="return confirm('¿Eliminar inscripción?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-2 px-4 text-center">No hay inscripciones aún.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection