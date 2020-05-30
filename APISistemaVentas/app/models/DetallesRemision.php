<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DetallesRemision extends Model
{
    protected $table = 'detalles_remision';
    protected $fillabel = [
        'idremision','idcliente','idproducto','almacen_general','almacen_salida','cantidad','subtotal','estado'
    ];
}
