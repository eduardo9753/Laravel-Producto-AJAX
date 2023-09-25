<?php

namespace App\Http\Controllers\admin\mercadopago;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MercadoPagoWebHookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Obtén el contenido de la solicitud (JSON del webhook)
        $payload = $request->getContent();

        // Obten la firma HMAC enviada por MercadoPago
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
        }
    }
}
