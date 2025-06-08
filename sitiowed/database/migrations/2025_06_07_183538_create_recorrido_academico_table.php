<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recorrido_academico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudiantes_id')->constrained()->cascadeOnDelete();
            $table->foreignId('materias_id')->constrained()->cascadeOnDelete();
            $table->foreignId('semestres_id')->constrained()->cascadeOnDelete();
            $table->foreignId('secciones_id')->constrained()->cascadeOnDelete();
            $table->foreignId('carreras_id')->constrained()->cascadeOnDelete();
            $table->integer('calificacion')->nullable();
            $table->enum('estado',['Activo','Inactivo'])->default('Activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recorrido_academico');
    }
};
