<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Provedores extends Model
{
    protected $table = 'Provedor';
    protected $fillabel = [
        'nombre', 'direccion', 'telefono'
    ];
}
