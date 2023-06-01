<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('home');
    }
}
