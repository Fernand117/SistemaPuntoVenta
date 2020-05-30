<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AlmacenSalida extends Model
{
    protected $table = 'almacen_salida';
    protected $fillabel = [
        'idproducto','cantidad_salida','cantidad_retorno','numero_unidad','fecha_salida','estado'
    ];
}
