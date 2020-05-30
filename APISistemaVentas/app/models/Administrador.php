<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'administrador';
    protected $fillabel = [
        'nombre','apellidop','apellidom','userid','estado'
    ];
}
