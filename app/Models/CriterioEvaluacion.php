<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CriterioEvaluacion extends Model
{
    protected $table = 'criterios_evaluacion';

    protected $fillable = ['resultado_aprendizaje_id', 'codigo', 'descripcion', 'peso_porcentaje', 'orden'];
}
