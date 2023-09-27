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

        // Procesa la notificación y toma las acciones necesarias
        $data = json_decode($payload, true);
        if ($data['type'] === 'payment') {
            // El evento es un pago completado, procesa la información
        }

        // Responde a la notificación con un código 200 OK
        Log::info('Datos' . $data . ' ');
    }
}
