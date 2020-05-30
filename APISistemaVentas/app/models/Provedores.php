<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Provedores extends Model
{
    protected $table = 'provedores';
    protected $fillabel = [
        'nombre', 'direccion', 'telefono','estado'
    ];
}
