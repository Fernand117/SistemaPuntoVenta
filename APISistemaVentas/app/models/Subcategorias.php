<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Subcategorias extends Model
{
    protected $table = 'Subcategorias';
    protected $fillabel = [
        'imagen', 'nombre', 'idcategoria'
    ];
}
