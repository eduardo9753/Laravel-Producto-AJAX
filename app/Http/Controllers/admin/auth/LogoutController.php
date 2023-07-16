<?php

namespace App\Http\Controllers\admin\auth; //RUTA DE LA CARPETA DEL CONTROLADOR CREADO

use App\Http\Controllers\Controller; //EXTENSION DEL CONTROLLADOR GENERAL
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    //logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}
