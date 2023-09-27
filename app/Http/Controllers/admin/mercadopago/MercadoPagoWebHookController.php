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
            // La firma es válida, procesa la notificación
            $data = json_decode($payload, true);

            // Resto del código...
            Log::error('Datos: ' . $data);
        } else {
            // La firma no es válida, ignora la notificación o registra un error
            $data = json_decode($payload, true);
            Log::error('id pago: ' . $data['data']['id']);
            Log::error('status: ' . $data['data']['status']);
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
