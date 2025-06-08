<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\semestre;
use App\Models\carrera;

class semestresController extends Controller
{
    public function index()
    {
        $semestres = semestre::all();
        return view('semestres.index', compact('semestres'));
    }
    public function create()
    {
        return view('semestres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        semestre::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('carreras.show', $carrera->id)->with('success', 'Semestre creado exitosamente');
    }
    public function associateSemestresForm(carrera $carrera)
    {
        $semestres = semestre::all(); // Obtener todos los semestres disponibles
        $carreraSemestres = $carrera->semestres->pluck('id')->toArray(); // IDs de semestres ya asociados

        return view('semestres.associate_semestres', compact('carrera', 'semestres', 'carreraSemestres'));
    }

    /**
     * Asocia (sincroniza) los semestres seleccionados con una carrera.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\carrera  $carrera
     * @return \Illuminate\Http\RedirectResponse
     */
    public function associateSemestres(Request $request, carrera $carrera)
    {
        $request->validate([
            'semestres' => 'nullable|array',
            'semestres.*' => 'exists:semestres,id', // Asegura que los IDs existen en la tabla semestres
        ]);

        // Sincroniza los semestres. Esto adjuntará los nuevos, desvinculará los eliminados
        // y mantendrá los existentes.
        $carrera->semestres()->sync($request->input('semestres', []));

        return redirect()->route('carreras.show', $carrera->id)->with('success', 'Semestres asociados exitosamente.');
    }
}
