<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class materia extends Model
{
    protected $table = 'materias';
    protected $fillable = ['nombre','semestres_id','secciones_id'];
    protected $guarded = [];

    public function recorrido_academico()
    {
        return $this->hasMany(recorrido_academico::class);
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
