<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
    protected $fillabel = [
        'imagen','nombre','descripcion','stock','idcategoria','idsubcategoria','idmarca','idprovedor'
    ];
}
