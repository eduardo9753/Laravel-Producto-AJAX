<?php

namespace App\Http\Controllers\admin\mercadopago;

use App\Http\Controllers\Controller;
use App\Models\Pay;
use MercadoPago\SDK;
use MercadoPago\Payment;
use MercadoPago\Refund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MercadoPagoController extends Controller
{
    //vista de los pagos generados por mercadopago
    public function index()
    {
        $payments = Pay::where('tipo_pago', '=', 'Producto')->get();
        return view('admin.mercadopago.index', ['payments' => $payments]);
    }

}
