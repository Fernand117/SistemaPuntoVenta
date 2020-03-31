<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Precios extends Model
{
    protected $table = 'Precios';
    protected $fillabel = [
        'tipo','precio','idproducto'
    ];
}
