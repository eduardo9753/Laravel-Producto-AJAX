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
        $secretKey = config('mercadopago.token');
        $payload = file_get_contents('php://input');
        $signature = $request->header('x-signature');


        Log::info('FIRMA ENVIADA POR MERCADOPAGO ' . $signature . 'FIRMA MIA: ' . hash_hmac('sha256', $payload, $secretKey));
        if (!$this->isValidSignature($payload, $secretKey, $signature)) {
            Log::info('LA FIRMA NO ES IGUAL');
        } else {
            // Procesa la notificación de Mercado Pago
            $data = json_decode($payload, true);
            Log::info('LA FIRMA ES CORRECTA' . $data);
        }
    }
}
