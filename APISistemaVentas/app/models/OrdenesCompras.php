<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class OrdenesCompras extends Model
{
    protected $table = 'ordenes_compras';
    protected $fillabel = [
        'nombre_producto','cantidad','fecha_entrega','idprovedor','estado'
    ];
}
