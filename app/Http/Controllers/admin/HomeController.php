<?php

namespace App\Http\Controllers\admin; //RUTA DE LA CARPETA DEL CONTROLADOR CREADO

use App\Http\Controllers\Controller; //EXTENSION DEL CONTROLLADOR GENERAL

class HomeController extends Controller
{
    //protegiendo rutas
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    //VISTA PRINCIPAL
    public function index()
    {
        return view('admin.home');
    }
}
