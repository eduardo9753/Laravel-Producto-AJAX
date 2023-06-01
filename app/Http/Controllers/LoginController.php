<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //LOGIN
    public function index()
    {
        return view('auth.index');
    }

    //logeo
    public function store(Request $request)
    {
        //validaciones
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remenber)) {
            return back()->with('mensaje', 'Las credenciales estan incorrectas');
        }

        //si todo esta bien redireccionamos al menu
        return redirect()->route('home.index');
    }
}
