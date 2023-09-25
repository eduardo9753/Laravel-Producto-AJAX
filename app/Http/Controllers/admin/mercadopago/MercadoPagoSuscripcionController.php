<?php

namespace App\Http\Controllers\admin\mercadopago;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MercadoPagoSuscripcionController extends Controller
{
    //vista de los pagos de suscripcion generados por mercadopago
    public function index()
    {
        return view('admin.mercadopago.index');
    }

}
