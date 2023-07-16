<?php

namespace App\Http\Controllers\admin\auth; //RUTA DE LA CARPETA DEL CONTROLADOR CREADO

use App\Http\Controllers\Controller; //EXTENSION DEL CONTROLLADOR GENERAL
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //REGISTRAR
    public function index()
    {
        return view('admin.auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4|max:30',
            'email' => 'required|unique:users|max:80',
            'password' => 'required|confirmed|min:6'
        ]);

        //guardamos los datos
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //guardamos los datos en la session iniciada 
        //los datos son email y password
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        //OTRA FORMA DE AUTENTICAR
        //auth()->attempt($request->only('email','password'));

        //redicreccionamos al menu principal
        return redirect()->route('home.index');
    }
}
