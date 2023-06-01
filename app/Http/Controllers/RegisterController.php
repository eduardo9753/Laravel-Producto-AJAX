<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //REGISTRAR
    public function index()
    {
        return view('auth.register');
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

        if(!auth()->attempt($request->only('email', 'password'), $request->remen))

        //redicreccionamos al menu principal
        return redirect()->route('home.index');
    }
}
