<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\estudiante;

class estudiantesController extends Controller
{
    public function index()
    {
        $estudiantes = estudiante::all();
        return view('estudiantes.index', compact('estudiantes'));
    }
    public function create()
    {
        return view('estudiantes.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'segundo_nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'correo' => 'required|email|max:255',
            'telefono' => 'required|string|max:255',
            'genero' => 'required|string|max:255',
            'matricula' => 'required|string|max:255',
        ]);

        $estudiante = estudiante::create([
            'nombre' => $request->nombre,
            'segundo_nombre' => $request->segundo_nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'genero' => $request->genero,
            'matricula' => $request->matricula,
        ]);

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante creado exitosamente');
    }
    public function edit($id)
    {
        $estudiante = estudiante::findOrFail($id);
        return view('estudiantes.edit', compact('estudiante'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'segundo_nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'correo' => 'required|email|max:255',
            'telefono' => 'required|string|max:255',
            'genero' => 'required|string|max:255',
            'matricula' => 'required|string|max:255',
        ]);

        $estudiante = estudiante::findOrFail($id);
        $estudiante->update([
            'nombre' => $request->nombre,
            'segundo_nombre' => $request->segundo_nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'genero' => $request->genero,
            'matricula' => $request->matricula,
        ]);

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado exitosamente');
    }
    public function show($id)
    {
        $estudiante = estudiante::findOrFail($id);
        return view('estudiantes.show', compact('estudiante'));
    }
    public function destroy($id)
    {
        $estudiante = estudiante::findOrFail($id);
        $estudiante->delete();

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado exitosamente');
    }
}
