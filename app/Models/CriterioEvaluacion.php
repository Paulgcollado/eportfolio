<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CriterioEvaluacion extends Model
{
    use HasFactory;

    protected $table = 'criterios_evaluacion';

    protected $fillable = ['resultado_aprendizaje_id', 'codigo', 'descripcion', 'peso_porcentaje', 'orden'];

    public function tareas(): BelongsToMany
    {
        return $this->belongsToMany(Tarea::class, 'criterios_tareas', 'tarea_id', 'criterio_evaluacion_id');
    }
}
