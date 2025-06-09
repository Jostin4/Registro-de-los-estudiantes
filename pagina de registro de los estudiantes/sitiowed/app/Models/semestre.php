<?php

namespace App\Models;

use App\Models\recorrido_academico;
use Illuminate\Database\Eloquent\Model;

class semestre extends Model
{
    protected $table = 'semestres';
    protected $fillable = ['nombre'];
    protected $guarded = [];

    public function materias()
    {
        return $this->hasMany(materia::class);
    }
    public function carrera()
    {
        return $this->belongsToMany(carrera::class,'carrera_semestres','semestres_id','carreras_id');
    }
   public function estudiantes()
    {
        return $this->belongsToMany(estudiante::class,'semestres_estudiantes','semestres_id','estudiantes_id');
    }
}
