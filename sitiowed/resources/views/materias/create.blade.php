@extends('layouts.app.layout')

@section('title', 'Crear Materia')

@section('content')
    <h1>Crear Materia</h1>
    <form method="POST" action="{{ route('materias.store') }}">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <button type="submit">Crear Materia</button>
    </form>
@endsection