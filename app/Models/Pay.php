<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;

     //VARIABLES DE LA TABLA
     protected $fillable = [
        'status',
        'pago_id',
        'tipo_pago'
    ];
}
