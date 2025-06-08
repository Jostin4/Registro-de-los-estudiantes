<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class carrera extends Model
{
    protected $table = 'carreras';
    protected $fillable = ['nombre'];
    protected $guarded = [];
    
    public function recorrido_academico()
    {
        return $this->hasMany(recorrido_academico::class);
    }
    public function semestres()
    {
        return $this->belongsToMany(semestre::class,'carrera_semestres','carreras_id','semestres_id');
    }
}
