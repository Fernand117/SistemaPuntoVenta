<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    protected $table = 'Marcas';
    protected $fillabel = [
        'imagen', 'nombre'
    ];
}
