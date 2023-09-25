<?php

namespace App\Http\Controllers\admin\mercadopago;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MercadoPago\SDK;
use MercadoPago\Subscription;

class MercadoPagoSuscripcionController extends Controller
{
    //vista de los pagos de suscripcion generados por mercadopago
    public function index()
    {
        return view('admin.mercadopago.index');
    }

    public function cancel()
    {
        SDK::setAccessToken(config('services.mercadopago.access_token'));

        $subscriptionId = '64207302170';
        $subscription = Subscription::find_by_id($subscriptionId);

        $subscription->cancel();

        if ($subscription->status == 'cancelled') {
            // La suscripción se canceló correctamente
            echo "cancelado";
        } else {
            // Hubo un error al cancelar la suscripción
            // Maneja el error adecuadamente
            echo "no cancelado";
        }
    }
}
