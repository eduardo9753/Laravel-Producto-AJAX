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
        $payments = Pay::all();
        return view('admin.mercadopago.index', ['payments' => $payments]);
    }

    //para reeembolsar un pago
    public function reembolso(Request $request, $paymentId)
    {
        try {
            // Verifica si estás en entorno de pruebas (sandbox) o producción
            $accessToken = config('mercadopago.token');

            // URL de la API de MercadoPago para realizar un reembolso
            $refundUrl = 'https://api.mercadopago.com/v1/payments/' . $paymentId . '/refunds';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->post($refundUrl);

            if ($response->successful()) {
                // El reembolso se realizó exitosamente
                $responseData = $response->json();
                // Puedes manejar la respuesta de MercadoPago aquí
                return response()->json($responseData);
            } else {
                // Hubo un error al realizar el reembolso
                $errorResponse = $response->json();
                // Maneja el error aquí
                return response()->json($errorResponse, $response->status());
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
