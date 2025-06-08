<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\materia;
use App\Models\semestre;
use App\Models\sección;

class materiasController extends Controller
{
    public function create()
    {
        $semestres = semestre::all();
        return view('materias.create', compact('semestres'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'semestres_id' => 'nullable|exists:semestres,id',
        ]);
    
        materia::create([
            'nombre' => $request->nombre,
            'semestres_id' => $request->semestres_id ?? null,
            'secciones_id' => null,
        ]);
    
        return back()->with('success', 'Materia añadida correctamente');
    }
}
