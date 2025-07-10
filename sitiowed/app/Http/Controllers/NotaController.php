<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;
use App\Models\Evaluacion;
use App\Models\MateriaEstudianteSemestre;
use App\Models\estudiante;

class NotaController extends Controller
{
    // Mostrar todas las notas
    public function index()
    {
        // Filtrar solo notas que tienen evaluación asociada
        $notas = Nota::with(['evaluacion.materia.semestres.carreras', 'evaluacion.semestre', 'estudiante'])
            ->whereHas('evaluacion') // Solo notas con evaluación válida
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        // Estadísticas solo de notas válidas
        $estadisticas = [
            'total_notas' => Nota::whereHas('evaluacion')->count(),
            'promedio_general' => Nota::whereHas('evaluacion')->avg('nota') ?? 0,
            'notas_aprobadas' => Nota::whereHas('evaluacion')->where('nota', '>=', 50)->count(),
            'notas_reprobadas' => Nota::whereHas('evaluacion')->where('nota', '<', 50)->count(),
            'notas_huérfanas' => Nota::whereDoesntHave('evaluacion')->count(), // Notas sin evaluación
        ];
        
        return view('notas.index', compact('notas', 'estadisticas'));
    }

    // Mostrar formulario para cargar notas de una evaluación
    public function cargar($evaluacionId)
    {
        try {
            // Cargar la evaluación con sus relaciones
            $evaluacion = Evaluacion::with(['materia', 'semestre'])->findOrFail($evaluacionId);
            
            // Verificar que la evaluación tenga materia y semestre
            if (!$evaluacion->materia) {
                return redirect()->back()->with('error', 'La evaluación no tiene una materia asignada.');
            }
            
            if (!$evaluacion->semestre) {
                return redirect()->back()->with('error', 'La evaluación no tiene un semestre asignado.');
            }
            
            // Buscar estudiantes inscritos en la materia y semestre de la evaluación
            $inscripciones = MateriaEstudianteSemestre::where('materia_id', $evaluacion->materia_id)
                ->where('semestre_id', $evaluacion->semestre_id)
                ->get();
            
            // Obtener los estudiantes
            $estudiantes = estudiante::whereIn('id', $inscripciones->pluck('estudiante_id'))
                ->orderBy('nombre')
                ->get();
            
            // Obtener notas existentes
            $notas = Nota::where('evaluacion_id', $evaluacionId)
                ->get()
                ->keyBy('estudiante_id');
            
            return view('notas.cargar', compact('evaluacion', 'estudiantes', 'notas'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar la evaluación: ' . $e->getMessage());
        }
    }

    // Guardar notas de los estudiantes para una evaluación
    public function guardar(Request $request, $evaluacionId)
    {
        try {
            $request->validate([
                'notas.*' => 'nullable|numeric|min:0|max:100',
            ]);
            
            $evaluacion = Evaluacion::with(['materia', 'semestre'])->findOrFail($evaluacionId);
            
            // Verificar que la evaluación tenga materia y semestre
            if (!$evaluacion->materia || !$evaluacion->semestre) {
                return redirect()->back()->with('error', 'La evaluación no tiene materia o semestre asignado.');
            }
            
            // Buscar estudiantes inscritos
            $inscripciones = MateriaEstudianteSemestre::where('materia_id', $evaluacion->materia_id)
                ->where('semestre_id', $evaluacion->semestre_id)
                ->get();
            
            $estudiantes = estudiante::whereIn('id', $inscripciones->pluck('estudiante_id'))->get();
            
            $notasGuardadas = 0;
            
            foreach ($estudiantes as $estudiante) {
                $notaValor = $request->input('notas.' . $estudiante->id);
                
                if ($notaValor !== null && $notaValor !== '') {
                    Nota::updateOrCreate(
                        [
                            'evaluacion_id' => $evaluacionId,
                            'estudiante_id' => $estudiante->id,
                        ],
                        [
                            'nota' => $notaValor,
                        ]
                    );
                    $notasGuardadas++;
                }
            }
            
            $mensaje = $notasGuardadas > 0 
                ? "Se guardaron {$notasGuardadas} notas correctamente."
                : "No se guardaron notas. Verifica que hayas ingresado al menos una calificación.";
            
            return redirect()->back()->with('success', $mensaje);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar las notas: ' . $e->getMessage());
        }
    }
}
