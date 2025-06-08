<?php

namespace App\Http\Controllers;

use App\Models\carrera;
use App\Models\estudiante;
use Illuminate\Http\Request;

class carrerasController extends Controller
{
    public function index()
    {
        $carreras = carrera::with('semestres')->get();
        return view('carreras.index', compact('carreras'));
    }

    public function create()
    {
        return view('carreras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $carrera = carrera::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('carreras.index')->with('success', 'Carrera creada exitosamente');
    }

    public function edit($id)
    {
        $carrera = carrera::findOrFail($id);
        return view('carreras.edit', compact('carrera'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        $carrera = carrera::findOrFail($id);
        $carrera->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('carreras.index')->with('success', 'Carrera actualizada exitosamente');
    }

    public function show($id)
    {
        $carrera = carrera::with('semestres', 'estudiantes')->findOrFail($id);
        // Solo muestra los estudiantes que aún NO están inscritos
        $estudiantesDisponibles = estudiante::whereNotIn('id', $carrera->estudiantes->pluck('id'))->get();
        return view('carreras.show', compact('carrera', 'estudiantesDisponibles'));
    }
    
    public function addEstudiante(Request $request, $carreraId)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
        ]);
        $carrera = carrera::findOrFail($carreraId);
        $carrera->estudiantes()->attach($request->estudiante_id);
        return redirect()->route('carreras.show', $carrera->id)->with('success', 'Estudiante añadido correctamente.');
    }

    public function destroy($id)
    {
        $carrera = carrera::findOrFail($id);
        $carrera->delete();

        return redirect()->route('carreras.index')->with('success', 'Carrera eliminada exitosamente');
    }
    public function removeEstudiante($carreraId, $estudianteId)
    {
        $carrera = carrera::findOrFail($carreraId);
        $carrera->estudiantes()->detach($estudianteId);
        return redirect()->route('carreras.show', $carrera->id)->with('success', 'Estudiante removido correctamente.');
    }
}
