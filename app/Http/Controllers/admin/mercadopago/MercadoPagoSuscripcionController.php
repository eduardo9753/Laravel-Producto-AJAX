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

    //METODO PARA  CANCELAR UNA SUSCRIPCION (DEJAR DE COBRAR UNA SUSCRIPCION) 
    public function cancel(Request $request)
    {
        // Configura tu clave secreta de MercadoPago
        $secretKey = config('mercadopago.token');

        // Construye la URL de la API de reembolso de MercadoPago
        $cancelUrl = "https://api.mercadopago.com/preapproval/cancel/$request->preapprovalId";

        // Realiza la solicitud HTTP para realizar el reembolso
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $secretKey,
            'Content-Type' => 'application/json',
        ])->post($cancelUrl);

        if ($response->successful()) {
            // Suscripción cancelada exitosamente
            return response()->json(['message' => 'Suscripción cancelada exitosamente'], 200);
        } else {
            // Hubo un error al cancelar la suscripción
            return response()->json(['error' => $response->body()], $response->status());
        }
    }
}
