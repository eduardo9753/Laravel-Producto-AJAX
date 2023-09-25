<?php

namespace App\Http\Controllers\admin\mercadopago;

use App\Http\Controllers\Controller;
use App\Models\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use MercadoPago\SDK;
use MercadoPago\Payment;
use MercadoPago\Subscription;

class MercadoPagoSuscripcionController extends Controller
{
    //vista de los pagos de suscripcion generados por mercadopago
    public function index()
    {
        $payments = Pay::where('tipo_pago', '=', 'Suscripcion')->get();
        return view('admin.mercadopago.list', ['payments' => $payments]);
    }
}
