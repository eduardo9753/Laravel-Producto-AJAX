<?php

namespace App\Http\Controllers\admin\auth; //RUTA DE LA CARPETA DEL CONTROLADOR CREADO

use App\Http\Controllers\Controller; //EXTENSION DEL CONTROLLADOR GENERAL
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //LOGIN
    public function index()
    {
        return view('admin.auth.index');
    }

    //logeo
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remenber)) {
            return back()->with('mensaje', 'Las credenciales estan incorrectas');
        }

        return redirect()->route('home.index');
    }
}
