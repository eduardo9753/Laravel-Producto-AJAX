<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    //VARIABLES DE LA TABLA
    protected $fillable = [
        'nombre',
        'precio',
        'stock',
        'user_id',
        'category_id'
    ];
}
