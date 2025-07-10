<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\estudiante;

class ListarEstudiantesCommand extends Command
{
    protected $signature = 'listar:estudiantes';
    protected $description = 'Listar todos los estudiantes';

    public function handle()
    {
        $this->info("=== ESTUDIANTES ===");
        $estudiantes = estudiante::all(['id', 'nombre', 'apellido_paterno', 'apellido_materno']);
        
        foreach ($estudiantes as $estudiante) {
            $this->line("ID: {$estudiante->id} | Nombre: {$estudiante->nombre} {$estudiante->apellido_paterno} {$estudiante->apellido_materno}");
        }
    }
} 