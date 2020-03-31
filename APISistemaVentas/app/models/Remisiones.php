<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Remisiones extends Model
{
    protected $table = 'remisiones';
    protected $fillabel = [
        'fecha_remision','numero_remision','estado_remision','descripcion','venta','total','idusuario','estado'
    ];
}
