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

    //METODO PARA  CANCELAR UN PAGO (COMPRA DE PRODUCTO) DEVOLUCION 
    public function cancel(Request $request)
    {
        // Configura tu clave secreta de MercadoPago
        $secretKey = config('mercadopago.token');

        // Define la cantidad a reembolsar (ajusta esto según tus necesidades)
        $amount = 10.0;

        // Construye la URL de la API de reembolso de MercadoPago
        $refundUrl = "https://api.mercadopago.com/v1/payments/$request->pago_id/refunds";

        // Realiza la solicitud HTTP para realizar el reembolso
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $secretKey,
            'Content-Type' => 'application/json',
        ])->post($refundUrl, [
            'amount' => $amount,
        ]);

        if ($response->successful()) {
            // Reembolso exitoso
            return response()->json(['message' => 'Reembolso exitoso'], 200);
        } else {
            // Hubo un error al realizar el reembolso
            return response()->json(['error' => $response->body()], $response->status());
        }
    }
}
