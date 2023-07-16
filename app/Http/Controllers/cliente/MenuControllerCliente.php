<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use App\Models\Juice;
use Illuminate\Http\Request;

class MenuControllerCliente extends Controller
{
    //INDEX MENU
    public function index()
    {
        return view('cliente.menu.index');
    }

    public function show($id)
    {
        $typi_id = $id;
        $juices = Juice::where('type_id', '=', $typi_id)->get();

        return view('cliente.menu.show', [
            'juices' => $juices
        ]);
    }
}
