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
        if ($payload['type'] === 'payment' && $payload['data']['status'] === 'approved') {
            // Aquí puedes agregar lógica para procesar el pago exitoso
            // Por ejemplo, puedes enviar una notificación por correo electrónico
            $this->sendPaymentNotification($payload['data']);
            Log::info('type:  ' . $payload['type']);
            Log::info('status:  ' . $payload['data']['status']);
            Log::info('id pago:  ' . $payload['data']['id']);
        }

        // Responde a la solicitud de Mercado Pago para confirmar la recepción
        return response()->json(['status' => 'ok']);
    }

    private function sendPaymentNotification($data)
    {
        Log::info('Datos:  ' . $data);
        // Aquí puedes implementar la lógica para enviar una notificación por correo electrónico
        // Por ejemplo, puedes utilizar el sistema de notificaciones de Laravel para enviar el correo
        // $user = User::find($data['customer_id']);
        // $user->notify(new PaymentNotification($data));
    }
}
