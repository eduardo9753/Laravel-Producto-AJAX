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

        $data = json_decode($payload, true);
        // Asumiendo que el evento del webhook es un pago exitoso
        if ($data['type'] === 'payment' && $data['data']['status'] === 'approved') {
            $save = Pay::create([
                'status' => $data['data']['status'],
                'pago_id' => $data['data']['id'], //con esta id se puede gestionar los datos en mercado pago
                'tipo_pago' => 'Producto', //$request->payment_type
            ]);

            if ($save) {
                // Responde a la solicitud de Mercado Pago para confirmar la recepción
                return response()->json(['status' => 'ok']);
                Log::info('PAGO GUARDADO CORRECTAMENTE');
            } else {
                Log::info('EL PAGO NO SE COMPLETO');
            }
        }
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
