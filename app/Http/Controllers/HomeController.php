<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //VISTA PRINCIPAL
    public function index()
    {
        return view('home');
    }
}
