<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ModuloFormativo extends Model
{
    use HasFactory;

    protected $table = "modulos_formativos";

    protected $fillable = [
        "ciclo_formativo_id",
        "nombre",
        "codigo",
        "horas_totales",
        "curso_escolar",
        "centro",
        "docente_id",
        "descripcion"
    ];

    // ------------------------------------------------------------------------
    // RELACIONES
    //
    // Varios módulos son impartidos por un docente.
    public function docente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'docente_id');
    }

    // En varios módulos están matriculados varios estudiantes.
    public function estudiantes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'matriculas', 'estudiante_id', 'modulo_formativo_id');
    }
}
