<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';
    protected $fillabel = [
        'nombre','apellidop','apellidom','username','clave','estado'
    ];
}
