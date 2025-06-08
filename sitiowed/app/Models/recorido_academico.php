<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class recorido_academico extends Model
{
    protected $table = 'recorrido_academico';
    protected $fillable = ['estudiantes_id','materias_id','semestres_id','secciones_id','calificacion','estado'];
    protected $guarded = [];
    
    public function estudiantes()
    {
        return $this->belongsTo(estudiante::class);
    }
    
    public function materias()
    {
        return $this->belongsTo(materia::class);
    }
    
    public function semestres()
    {
        return $this->belongsTo(semestre::class);
    }
    
    public function secciones()
    {
        return $this->belongsTo(seccion::class);
    }
    
}
