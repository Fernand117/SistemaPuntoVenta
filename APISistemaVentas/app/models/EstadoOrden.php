<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class EstadoOrden extends Model
{
    protected $table = 'estado_orden';
    protected $fillabel = [
        'estado'
    ];
}