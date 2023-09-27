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
        // Verificar la autenticidad de la solicitud de Mercado Pago aquí si es necesario

        $payload = json_decode($request->getContent(), true);

        // Asumiendo que el evento del webhook es un pago exitoso
        if ($payload['type'] === 'payment') {
            $paymentId = $payload['data']['id'];

            // Aquí puedes actualizar el estado de la orden en tu base de datos
            // Puedes agregar lógica adicional según tus necesidades

            // Registra la notificación en el registro (log)
            Log::info('Mercado Pago Webhook received for payment ' . $paymentId . ' - DAtos: ' . $payload['data']);
        }

        // Responde a la solicitud de Mercado Pago para confirmar la recepción
        return response()->json(['status' => 'ok']);
    }
}
