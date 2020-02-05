<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    protected $table = 'marcas';
    protected $fillabel = [
        'imagen', 'nombre'
    ];
}
