<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = 'categorias';
    protected $fillabel = [
        'imagen', 'nombre'
    ];
}
