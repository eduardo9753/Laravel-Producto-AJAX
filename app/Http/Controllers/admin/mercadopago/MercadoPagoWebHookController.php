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
            $amount = $payload['data']['transaction_amount'];
            // Puedes acceder a más datos según sea necesario
            
            // Aquí puedes actualizar el estado de la orden en tu base de datos
            // Puedes agregar lógica adicional según tus necesidades
        }

        Log::info('paymentId: ' . $paymentId . '');
        Log::info('amount:  ' . $amount . '');
        Log::info('type:  ' . $payload['type'] . '');
    }
}
