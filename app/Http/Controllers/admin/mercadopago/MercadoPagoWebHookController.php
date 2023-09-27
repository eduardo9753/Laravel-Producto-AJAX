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
        $payload = json_decode($request->getContent(), true);

        // Asumiendo que el evento del webhook es un pago exitoso
        if ($payload['type'] === 'payment') {
            $paymentId = $payload['data']['id'];
            $status = $payload['data']['status'];

            // Aquí puedes actualizar el estado de la orden en tu base de datos
            // Puedes agregar lógica adicional según tus necesidades

            // Registra la notificación en el registro (log)
            Log::info('Mercado Pago Webhook received for payment ' . $paymentId . ' - Status: ' . $status);
        }

        // Asumiendo que el evento del webhook es relacionado con una suscripción
        if ($payload['type'] === 'subscription') {
            $subscriptionId = $payload['data']['id'];
            $status = $payload['data']['status'];

            // Aquí puedes actualizar el estado de la suscripción en tu base de datos
            // Puedes agregar lógica adicional según tus necesidades

            // Registra la notificación en el registro (log)
            Log::info('Mercado Pago Webhook received for subscription ' . $subscriptionId . ' - Status: ' . $status);
        }
    }
}
