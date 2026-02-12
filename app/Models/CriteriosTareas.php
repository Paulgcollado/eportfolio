<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriteriosTareas extends Model
{
    use HasFactory;

    protected $table = 'criterios_tareas';

    protected $fillable = ['tarea_id', 'criterio_evaluacion_id'];
}
