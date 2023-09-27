<?php

namespace App\Http\Controllers\admin\mercadopago;

use App\Http\Controllers\Controller;
use App\Models\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MercadoPagoWebHookController extends Controller
{
    public function index(Request $request)
    {
        /* Obtén el contenido de la solicitud (JSON del webhook)
        $payload = $request->getContent();
        dd($payload);

         Obten la firma HMAC enviada por MercadoPago
        $signature = $request->header('x-signature');

        // Verifica la firma HMAC
        $secretKey = config('mercadopago.client_secret');

        if (hash_hmac('sha256', $payload, $secretKey) === $signature) {
            // La firma es válida, el webhook es auténtico

            // Procesa la notificación y toma las acciones necesarias
            $data = json_decode($payload, true);
            if ($data['type'] === 'payment') {
                // El evento es un pago completado, procesa la información
            }

            // Responde a la notificación con un código 200 OK
            return response()->json(['message' => 'Webhook received'], 200);
        } else {
            // La firma no es válida, ignora la notificación o maneja el error
            return response()->json(['message' => 'Invalid webhook request'], 400);
        }*/

        // Verificar la autenticidad de la solicitud de Mercado Pago aquí si es necesario
        
        $payload = json_decode($request->getContent(), true);

        // Asumiendo que el evento del webhook es un pago exitoso
        if ($payload['type'] === 'payment') {
            $paymentId = $payload['data']['id'];
            $orderId = $payload['data']['order']['id'];
            $status = $payload['data']['status'];
            
            Pay::create([
                'status' => $status,
                'pago_id' => $paymentId, //con esta id se puede gestionar los datos en mercado pago
                'tipo_pago' => 'Producto', //$request->payment_type
            ]);

            // Registra la notificación en el registro (log)
            Log::info('Mercado Pago Webhook received for payment ' . $paymentId . ' - Status: ' . $status);
        }

        // Responde a la solicitud de Mercado Pago para confirmar la recepción
        return response()->json(['status' => 'ok']);
    }
}
