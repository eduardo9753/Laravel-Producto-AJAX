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


        Log::info('datos de captura ' . $payload . '');
        Log::info('Firma ' . $signature . '');
       
        if (hash_hmac('sha256', $payload, $secretKey) === $signature) {
            // La firma es válida, el webhook es auténtico

            // Procesa la notificación y toma las acciones necesarias
            $data = json_decode($payload, true);
            /*if ($data['type'] === 'payment') {
                // El evento es un pago completado, procesa la información
                $paymentId = $data['data']['id'];
                $status = $data['data']['status'];
                Pay::create([
                    'status' => $status,
                    'pago_id' => $paymentId, //con esta id se puede gestionar los datos en mercado pago
                    'tipo_pago' => 'Producto', //$request->payment_type
                ]);
            }*/


            // Responde a la notificación con un código 200 OK
            //return response()->json(['message' => 'Webhook received'], 200);
            Log::info('Mercado Pago Webhook received for payment ' . $data['data']['id'] . ' - Status: ' . $data['data']['status']);
        } else {
            // La firma no es válida, ignora la notificación o maneja el error
            //return response()->json(['message' => 'Invalid webhook request'], 400);
        }
    }
}
