<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evidencia extends Model
{
    use HasFactory;

    protected $table = 'evidencias';

    protected $fillable = ['estudiante_id', 'criterio_evaluacion_id', 'url', 'descripcion', 'estado_validacion'];

    // ------------------------------------------------------------------------
    // RELACIONES
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'estudiante_id');
    }
}
