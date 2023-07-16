<?php

namespace App\Http\Controllers;

use App\Mail\EnviarCorreo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //VISTA PARA MANDAR EL CORREO
    public function index()
    {
        return view('mail.index');
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        Mail::to($request->email)->send(new EnviarCorreo);
        return back()->with('mensaje', 'Se envio un mensaje al correo proporcionado');
    }

    public function recover()
    {
        return view('mail.recover');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:80',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::whereEmail($request->email)->first();

        if ($user) {
            /*actualizamos datos*/
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return back()->with('mensaje', 'Se restablecio los datos correctamente');
        } else {
            return back()->with('mensaje', 'El correo proporcionado no existe');
        }
    }
}
