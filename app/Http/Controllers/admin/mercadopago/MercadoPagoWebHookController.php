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
        if ($payload['type'] === 'payment' && $payload['data']['status'] === 'approved') {
            $paymentId = $payload['data']['id'];

            $save = Pay::create([
                'status' => 'approved',
                'pago_id' => $paymentId, //con esta id se puede gestionar los datos en mercado pago
                'tipo_pago' => 'Producto', //$request->payment_type
            ]);

            if ($save) {
                Log::info('Datos guardados correctamente');
            } else {
                Log::error('Datos no guardados');
            }
        } else {
            Log::error('Error de tipos de dato: ');
        }

        // Responde a la solicitud de Mercado Pago para confirmar la recepción
        return response()->json(['status' => 'ok']);
    }
}
