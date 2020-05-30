<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Subcategorias extends Model
{
    protected $table = 'subcategorias';
    protected $fillabel = [
        'imagen', 'nombre', 'idcategoria','estado'
    ];
}
