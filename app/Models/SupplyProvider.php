<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyProvider extends Model
{
    use HasFactory;

    //VARIABLES DE LA TABLA
    protected $fillable = [
        'provider_id',
        'supply_id',
    ];
}
