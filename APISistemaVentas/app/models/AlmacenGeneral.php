<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AlmacenGeneral extends Model
{
    protected $table = 'almacen_general';
    protected $fillabel = [
        'idproducto','cantidad','fecha_ingreso','idcompra','estado'
    ];
}
