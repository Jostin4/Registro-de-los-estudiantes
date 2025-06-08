<?php

namespace App\Http\Controllers;

use App\Models\carrera;
use App\Models\recorido_academico;
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
        $carrera = carrera::findOrFail($id);
        return view('carreras.show', compact('carrera'));
    }

    public function destroy($id)
    {
        $carrera = carrera::findOrFail($id);
        $carrera->delete();

        return redirect()->route('carreras.index')->with('success', 'Carrera eliminada exitosamente');
    }
}
