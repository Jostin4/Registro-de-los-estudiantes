<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\estudiante;
use App\Models\carrera;
use App\Models\semestre;
use App\Models\materia;
use App\Models\MateriaEstudianteSemestre;

class VerificarInscripcionCommand extends Command
{
    protected $signature = 'verificar:inscripcion {estudiante_id} {carrera_id}';
    protected $description = 'Verificar el estado de inscripción de un estudiante en una carrera';

    public function handle()
    {
        $estudianteId = $this->argument('estudiante_id');
        $carreraId = $this->argument('carrera_id');

        $estudiante = estudiante::find($estudianteId);
        $carrera = carrera::with(['semestres.materias'])->find($carreraId);

        if (!$estudiante) {
            $this->error("Estudiante con ID {$estudianteId} no encontrado");
            return 1;
        }

        if (!$carrera) {
            $this->error("Carrera con ID {$carreraId} no encontrada");
            return 1;
        }

        $this->info("=== VERIFICACIÓN DE INSCRIPCIÓN ===");
        $this->info("Estudiante: {$estudiante->nombre} {$estudiante->apellido_paterno}");
        $this->info("Carrera: {$carrera->nombre}");
        $this->line("");

        // Verificar inscripción en carrera
        $estaInscritoEnCarrera = $carrera->estudiantes->contains($estudiante->id);
        $this->info("1. Inscripción en carrera: " . ($estaInscritoEnCarrera ? "✓ SÍ" : "✗ NO"));

        if (!$estaInscritoEnCarrera) {
            $this->error("El estudiante NO está inscrito en la carrera");
            return 1;
        }

        // Verificar semestres
        $this->info("2. Semestres de la carrera:");
        foreach ($carrera->semestres as $semestre) {
            $estaInscritoEnSemestre = $estudiante->semestres->contains($semestre->id);
            $this->line("   - {$semestre->nombre}: " . ($estaInscritoEnSemestre ? "✓ Inscrito" : "✗ No inscrito"));
        }

        // Verificar primer semestre
        $primerSemestre = $carrera->semestres->sortBy('id')->first();
        if ($primerSemestre) {
            $this->info("3. Primer semestre: {$primerSemestre->nombre}");
            $estaInscritoEnPrimerSemestre = $estudiante->semestres->contains($primerSemestre->id);
            $this->line("   Inscrito en primer semestre: " . ($estaInscritoEnPrimerSemestre ? "✓ SÍ" : "✗ NO"));

            // Verificar materias del primer semestre
            $this->info("4. Materias del primer semestre:");
            if ($primerSemestre->materias->count() > 0) {
                foreach ($primerSemestre->materias as $materia) {
                    $inscripcionMateria = MateriaEstudianteSemestre::where([
                        'estudiante_id' => $estudiante->id,
                        'materia_id' => $materia->id,
                        'semestre_id' => $primerSemestre->id
                    ])->first();

                    $this->line("   - {$materia->nombre} ({$materia->codigo}): " . 
                        ($inscripcionMateria ? "✓ Inscrito ({$inscripcionMateria->estado})" : "✗ No inscrito"));
                }
            } else {
                $this->warn("   No hay materias asignadas al primer semestre");
            }
        } else {
            $this->error("La carrera no tiene semestres");
        }

        $this->line("");
        $this->info("=== FIN DE VERIFICACIÓN ===");
    }
} 