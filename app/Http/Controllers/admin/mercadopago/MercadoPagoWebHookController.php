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
        //Obtén el contenido de la solicitud (JSON del webhook)
        $payload = $request->getContent();

        //Obten la firma HMAC enviada por MercadoPago
        $signature = $request->header('x-signature');

        // Verifica la firma HMAC
        $secretKey = config('mercadopago.token');




        Log::info('FIRMA ENVIADA POR MERCADOPAGO ' . $signature . 'FIRMA MIA: ' . hash_hmac('sha256', $payload, $secretKey));
        if (hash_hmac('sha256', $payload, $secretKey) === $signature) {
            // La firma es válida, el webhook es auténtico

            // Procesa la notificación y toma las acciones necesarias
            $data = json_decode($payload, true);


            Log::info('DATOS DE LA COMPRAR' . $payload . '');
            Log::info('FIRMA ENVIADA POR MERCADOPAGO ' . $signature . '');
            Log::info('ID DEL PAGO ' . $data['data']['id'] . '');
            Log::info('ESTATUS DEL PAGO ' . $data['data']['status'] . '');
            Log::info('TIPO DEL PAGO ' . $data['type'] . '');
            Log::info('Mercado Pago Webhook received for payment ' . $data['data']['id'] . ' - Status: ' . $data['data']['status']);
        } else {
            // La firma no es válida, ignora la notificación o maneja el error
            //return response()->json(['message' => 'Invalid webhook request'], 400);
            Log::info('LA FIRMA NO ES IGUAL');
        }
    }
}
