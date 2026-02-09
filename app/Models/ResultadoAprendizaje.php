<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadoAprendizaje extends Model
{
        protected $table = 'resultados_aprendizaje';

        protected $fillable = ['modulo_formativo_id', 'codigo', 'descripcion', 'peso_procentaje', 'orden'];
}
