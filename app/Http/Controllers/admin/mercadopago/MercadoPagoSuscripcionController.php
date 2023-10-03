<?php

namespace App\Http\Controllers\admin\mercadopago;

use App\Http\Controllers\Controller;
use App\Models\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use MercadoPago\SDK;
use MercadoPago\Preapproval;


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
        try {
            // Configura las credenciales de Mercado Pago
            SDK::setAccessToken(config('mercadopago.token'));

            // Obtén la instancia de Preapproval
            $preapproval = Preapproval::find_by_id($request->preapprovalId);

            // Realiza la cancelación de la suscripción
            $preapproval->status = 'cancelled';
            $preapproval->update();

            // Verifica el estado de la suscripción después de la actualización
            $preapproval = Preapproval::find_by_id($request->preapprovalId);

            if ($preapproval->status === 'cancelled') {
                // Suscripción cancelada correctamente
                return response()->json(['success' => true, 'message' => 'Suscripción cancelada exitosamente']);
            } else {
                return response()->json(['success' => false, 'message' => 'Error al cancelar la suscripción']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
