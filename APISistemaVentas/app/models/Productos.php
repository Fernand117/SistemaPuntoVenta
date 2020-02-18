<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
    protected  $primaryKey = 'codigo';
    protected $fillabel = [
        'codigo','imagen','nombre','descripcion','idcategoria','idsubcategoria','idmarca','idprovedor','estado'
    ];
}
