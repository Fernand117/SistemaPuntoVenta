<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';
    protected $fillabel = [
        'nombre', 'apellidop', 'apellidom', 'direccion', 'telefono'
    ];
}
