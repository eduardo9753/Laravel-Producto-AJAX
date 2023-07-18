<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactoControllerCliente extends Controller
{
    //index contacto
    public function index()
    {
        return view('cliente.contacto.index');
    }
}
