<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use App\Models\Juice;
use App\Models\Type;
use Illuminate\Http\Request;

class HomeControllerCliente extends Controller
{
    //pagina principal
    public function index()
    {
        $types = Type::all();
        return view('cliente.home', [
            'types' => $types
        ]);
    }
}
