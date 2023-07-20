<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juice extends Model
{
    use HasFactory;

    //VARIABLES DE LA TABLA
    protected $fillable = [
        'nombre',
        'imagen',
        'precio',
        'descripcion',
        'user_id',
        'type_id'
    ];
}
