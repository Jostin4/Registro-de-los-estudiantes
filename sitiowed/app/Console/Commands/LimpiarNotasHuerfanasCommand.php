<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Nota;

class LimpiarNotasHuerfanasCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notas:limpiar-huerfanas {--dry-run : Mostrar cuántas notas se eliminarían sin ejecutar la acción}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina las notas que no tienen una evaluación asociada';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Buscando notas huérfanas...');

        // Contar notas huérfanas
        $notasHuerfanas = Nota::whereDoesntHave('evaluacion')->get();
        $count = $notasHuerfanas->count();

        if ($count === 0) {
            $this->info('✅ No se encontraron notas huérfanas.');
            return 0;
        }

        $this->warn("⚠️  Se encontraron {$count} notas huérfanas.");

        if ($this->option('dry-run')) {
            $this->info('🔍 Modo de prueba - No se eliminarán notas.');
            $this->table(
                ['ID', 'Estudiante', 'Nota', 'Fecha Creación'],
                $notasHuerfanas->map(function ($nota) {
                    return [
                        $nota->id,
                        $nota->estudiante ? $nota->estudiante->nombre . ' ' . $nota->estudiante->apellido : 'N/A',
                        $nota->nota,
                        $nota->created_at ? $nota->created_at->format('d/m/Y H:i') : 'N/A'
                    ];
                })->toArray()
            );
            return 0;
        }

        if (!$this->confirm("¿Estás seguro de que quieres eliminar {$count} notas huérfanas?")) {
            $this->info('❌ Operación cancelada.');
            return 0;
        }

        $this->info('🗑️  Eliminando notas huérfanas...');

        $bar = $this->output->createProgressBar($count);
        $bar->start();

        foreach ($notasHuerfanas as $nota) {
            $nota->delete();
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        $this->info("✅ Se eliminaron {$count} notas huérfanas correctamente.");
        
        return 0;
    }
}
