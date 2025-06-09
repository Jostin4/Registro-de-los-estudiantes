<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class estudiante extends Model
{
    protected $table = 'estudiantes';
    protected $fillable = ['nombre','segundo_nombre','apellido_paterno','apellido_materno','fecha_nacimiento','correo','telefono','genero','estado','matricula'];
    protected $guarded = [];

    public function semestres()
    {
        return $this->belongsToMany(semestre::class,'semestres_estudiantes','estudiantes_id','semestres_id');
    }
    public function carreras()
    {
        return $this->belongsToMany(carrera::class,'carrera_estudiantes','estudiantes_id','carreras_id');
    }
}
