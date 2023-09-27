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

        // Obtén el contenido de la solicitud del webhook
        $payload = $request->getContent();

        // Decodifica el contenido JSON en un arreglo asociativo
        $data = json_decode($payload, true);

        // Registra los datos del webhook en el registro de eventos (Log)
        Log::info('Datos del webhook de Mercado Pago:');
        Log::info(json_encode($data, JSON_PRETTY_PRINT));

        // Realiza otras acciones según sea necesario, como procesar los datos

        // Responde con un código de estado 200 para confirmar la recepción
        return response()->json(['message' => 'Notificación recibida'], 200);

        /* $jsonData = $request->getContent(); // Obtén la cadena JSON de la solicitud
        $dataArray = json_decode($jsonData, true); // Convierte la cadena JSON en un arreglo asociativo

        //Verifica si existe un campo "preapproval_id" en los datos
        if (isset($dataArray['preapproval_id'])) {
           
            $subscriptionId = $dataArray['preapproval_id'];
            $save = Pay::create([
                'status' => 'approved',
                'pago_id' => $subscriptionId, //con esta id se puede gestionar los datos en mercado pago
                'tipo_pago' => 'Suscripcion', //$request->payment_type
            ]);

            if ($save) {
                Log::info('Datos de la suscripcion guardados correctamente');
                return response()->json(['status' => 'ok']);
            } else {
                Log::error('Datos de la suscripcion no guardados');
            }
        } else if ($dataArray['type'] === 'payment') {
            
            $id_pago = $dataArray['data']['id'];
            $save = Pay::create([
                'status' => 'approved',
                'pago_id' => $id_pago, //con esta id se puede gestionar los datos en mercado pago
                'tipo_pago' => 'Producto', //$request->payment_type
            ]);

            if ($save) {
                Log::info('Datos de la compra guardado correctamente');
                return response()->json(['status' => 'ok']);
            } else {
                Log::error('Datos de la compra no guardados');
            }
        } else {
            Log::error('Dato no reconocido');
        }*/
    }
}
