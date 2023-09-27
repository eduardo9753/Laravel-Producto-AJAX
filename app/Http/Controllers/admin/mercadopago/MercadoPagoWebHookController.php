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

        // Verifica la firma utilizando el Access Token
        $signature = $request->header('x-signature');
        $payload = $request->getContent();

        if ($this->verifySignature($payload, $signature, $accessToken)) {
            // Verifica si $payload es una cadena JSON válida
            $data = json_decode($payload, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
                // La decodificación fue exitosa y $data es un array
                if (isset($data['type']) && $data['type'] === 'payment') {
                    // Asumiendo que el evento del webhook es un pago exitoso
                    // Resto del código...
                }
            } else {
                // La cadena JSON no es válida
                Log::error('Payload de Mercado Pago no es JSON válido: ' . $payload);
                return response()->json(['status' => 'error']);
            }
        } else {
            // La firma no es válida, ignora la notificación o registra un error
            Log::error('Firma de Mercado Pago no válida: ' . $signature);
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
