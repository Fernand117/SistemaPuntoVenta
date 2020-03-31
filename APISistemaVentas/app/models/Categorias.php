<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = 'Categorias';
    protected $fillabel = [
        'imagen', 'nombre'
    ];
}
