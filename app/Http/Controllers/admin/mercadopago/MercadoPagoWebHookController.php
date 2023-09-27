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
        // Obtén el Access Token de Mercado Pago
        $accessToken = config('mercadopago.token');

        // Verifica la firma utilizando el Access Token (como se explicó anteriormente)
        $payload = $request->getContent();

        if ($this->verifySignature($payload, $request->header('x-signature'), $accessToken)) {
            $data = json_decode($payload, true);

            // Asegúrate de que la notificación sea de un pago exitoso
            if ($data['type'] === 'payment' && $data['data']['status'] === 'approved') {
                // Accede a los datos del pago
                $paymentId = $data['data']['id'];
                $paymentStatus = $data['data']['status'];

                // Aquí puedes procesar los datos del pago
                // Por ejemplo, actualiza el estado de la orden en tu base de datos
                // o envía notificaciones por correo electrónico al cliente
            }

            // Responde a la solicitud de Mercado Pago para confirmar la recepción
            return response()->json(['status' => 'ok']);
        } else {
            // La firma no es válida, ignora la notificación o registra un error
            $data = json_decode($payload, true);
            Log::error('id del pago: ' . $data['data']['id']);
            Log::error('Firma de Mercado Pago no válida: ' . $request->header('x-signature'));
            return response()->json(['status' => 'error']);
        }
    }

    private function verifySignature($payload, $signature, $accessToken)
    {
        $expectedSignature = hash_hmac('sha256', $payload, $accessToken);
        return $signature === $expectedSignature;
    }

    private function sendPaymentNotification($data)
    {
        // Implementa la lógica para enviar una notificación por correo electrónico
        // ...
    }
}
