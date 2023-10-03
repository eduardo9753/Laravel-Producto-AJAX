<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use App\Models\Pay;
use Illuminate\Http\Request;
use MercadoPago\SDK;
use MercadoPago\Preference;



class MercadoPagoSuscripcionControllerCliente extends Controller
{
    public function __construct()
    {
    }

    //
    public function index()
    {
        return view('cliente.mercadopago.suscripcion');
    }

    //AQUI VIENE LA INFORMACION PARA PREPARAR EL PAGO CON MERCADOPAGO
    //DE ALLI DEBEMOS DEVOLVER EL "preference_id" PARA PODER ACCEDER 
    //AL BOTON DE PAGO Y CONTINUAR CON EL COBRO 
    public function pay()
    {

        // Configura las credenciales de Mercado Pago
        SDK::setAccessToken(config('mercadopago.token'));

        // Crea un objeto de preferencia de suscripción
        $preference = new Preference();

        // Configura los detalles de la suscripción
        $preference->items = [
            [
                'title' => 'Suscripción Mensual',
                'quantity' => 1,
                'unit_price' => 19.90, // Precio mensual
            ]
        ];

        // esta suscripcion lo cree en mercadopago
        $preference->subscription_plan_id = '2c9380848ab2cb05018aba814d4c05a0'; // lo cree en la cuenta de mercadopago en la seccion de "Planes de Suscripciones"


        $preference->back_urls = [
            'success' => route('mercadopago.suscription.success'),
            'failure' => route('mercadopago.suscription.failure'),
            'pending' => route('mercadopago.suscription.pending'),
        ];
        $preference->auto_return = 'approved'; // Redirige automáticamente al usuario después de un pago aprobado


        // Guarda la preferencia
        $save = $preference->save();

        // Redirige al usuario al checkout de Mercado Pago para la suscripción
        // IMPORTANTE CUANDO ES SUSCRIPCION YA NO SE ENVIA LA $preference->id. ESO SOLO SE PASA EN CUANDO SE COMPRA PRODUCTOS
        if ($save) {
            $dato = [
                'init_point' =>  'https://www.mercadopago.com.pe/subscriptions/checkout?preapproval_plan_id=2c9380848ab2cb05018aba814d4c05a0'
            ];
            return response()->json([
                'code' => 1,
                'msg' => $dato
            ]);
        } else {
            return response()->json([
                'code' => 0,
                'msg' => 'Error de Datos'
            ]);
        }
    }


    public function success(Request $request)
    {

        dd($request);
        /*puedes registrarlo en la base de datos
        $save = Pay::create([
            'status' => 'approved',
            'pago_id' => $request->preapproval_id, //id es distinto de un pago normal , es usado para pagos recurrentes 
            'tipo_pago' => 'Suscripcion', // $request->payment_type
        ]);

        if ($save) {
            return redirect()->route('inicio.index')->with('pay', 'Se realizó el pago de tu suscripcion correctamente');
        } else {
            return redirect()->route('inicio.index')->with('nopay', 'No se realizó el pago de tu suscripcion correctamente');
        }*/

        
    }

    public function failure()
    {
        return "error de Suscripcion";
    }

    public function pending()
    {
        return "Suscripcion Pendiente";
    }
}
