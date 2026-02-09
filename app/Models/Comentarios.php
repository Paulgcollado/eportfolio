<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    protected $table = 'comentarios';

    protected $fillable = ['evidencia_id', 'user_id', 'contenido', 'tipo'];
}
