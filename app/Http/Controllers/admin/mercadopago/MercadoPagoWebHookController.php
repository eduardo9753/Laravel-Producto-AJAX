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
        $jsonData = $request->getContent(); // Obtén la cadena JSON de la solicitud
        $dataArray = json_decode($jsonData, true); // Convierte la cadena JSON en un arreglo asociativo

        Log::info('Datos tipo de comprar'. $dataArray['type']);
        /* Asumiendo que el evento del webhook es un pago exitoso
        if ($dataArray['type'] === 'payment') {
            $id_pago = $dataArray['data']['id'];

            $save = Pay::create([
                'status' => 'approved',
                'pago_id' => $id_pago, //con esta id se puede gestionar los datos en mercado pago
                'tipo_pago' => 'Producto', //$request->payment_type
            ]);

            if ($save) {
                Log::info('Datos de la compra guardados correctamente');
                return response()->json(['status' => 'ok']);
            } else {
                Log::error('Datos de la compra no guardados');
            }
        } else {
            Log::error('Error de tipos de dato: ');
        }


        // Asumiendo que el evento del webhook es relacionado con una suscripción
        if ($dataArray['type'] === 'subscription') {
            $id_pago = $dataArray['data']['id'];

            $save = Pay::create([
                'status' => 'approved',
                'pago_id' => $id_pago, //con esta id se puede gestionar los datos en mercado pago
                'tipo_pago' => 'Producto', //$request->payment_type
            ]);

            if ($save) {
                Log::info('Datos de la suscripcion guardados correctamente');
                return response()->json(['status' => 'ok']);
            } else {
                Log::error('Datos de la suscripcion no guardados');
            }
        } else {
            Log::error('Error de tipos de dato: ');
        }*/
    }
}
