<?php

namespace App\Http\Controllers\admin\mercadopago;

use App\Http\Controllers\Controller;
use App\Models\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use MercadoPago\SDK;
use MercadoPago\Payment;
use MercadoPago\Subscription;

class MercadoPagoSuscripcionController extends Controller
{
    //vista de los pagos de suscripcion generados por mercadopago
    public function index()
    {
        $payments = Pay::where('tipo_pago', '=', 'Suscripcion')->get();
        return view('admin.mercadopago.list', ['payments' => $payments]);
    }

    //METODO PARA  CANCELAR UNA SUSCRIPCION (DEJAR DE COBRAR UNA SUSCRIPCION) 
    public function cancel(Request $request)
    {
        // Crea una instancia del cliente HTTP Guzzle
        $client = new Client();

        // Define las credenciales de acceso (token) de tu cuenta de Mercado Pago
        $accessToken = config('mercadopago.token'); // Reemplaza con tu token real

        // Construye la URL del endpoint de cancelación de suscripción
        $url = "https://api.mercadopago.com/preapproval/$request->preapprovalId/cancel";

        try {
            // Realiza una solicitud POST a la URL de cancelación
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                ],
            ]);

            // Verifica el código de estado de la respuesta
            if ($response->getStatusCode() === 200) {
                // Suscripción cancelada con éxito
                return response()->json(['message' => 'Suscripción cancelada con éxito'], 200);
            } else {
                // Error al cancelar la suscripción
                return response()->json(['error' => 'Error al cancelar la suscripción'], 500);
            }
        } catch (\Exception $e) {
            // Manejo de errores de la solicitud
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
