<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class OrdenesCompras extends Model
{
    protected $table = 'ordenes_compras';
    protected $fillabel = [
        'remision_compra','fecha_entrga','idprovedor','estado'
    ];
}
