<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeControllerCliente extends Controller
{
    //pagina principal
    public function index()
    {
        return view('cliente.home');
    }
}
