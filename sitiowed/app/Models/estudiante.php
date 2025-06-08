<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class estudiante extends Model
{
    protected $table = 'estudiantes';
    protected $fillable = ['nombre','segundo_nombre','apellido_paterno','apellido_materno','fecha_nacimiento','correo','telefono','genero','estado','matricula'];
    protected $guarded = [];

    public function recorrido_academico()
    {
        return $this->hasMany(recorrido_academico::class);
    }
    
}
