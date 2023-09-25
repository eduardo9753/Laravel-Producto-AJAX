<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use App\Models\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;

class MercadoPagoControllerCliente extends Controller
{
    public function __construct()
    {
    }

    //
    public function index()
    {
        return view('cliente.mercadopago.index');
    }

    //AQUI VIENE LA INFORMACION PARA PREPARAR EL PAGO CON MERCADOPAGO
    //DE ALLI DEBEMOS DEVOLVER EL "preference_id" PARA PODER ACCEDER 
    //AL BOTON DE PAGO Y CONTINUAR CON EL COBRO 
    public function pay()
    {
        // Agrega credenciales
        SDK::setAccessToken(config('mercadopago.token'));
        $public_key = config('mercadopago.public_key');
        $preference = new Preference();
        $carrito = [];

        // Crea un ítem en la preferencia
        $count = 1;
        while ($count <= 3) {
            $item = new Item();
            $item->title = 'Mi producto';
            $item->quantity = $count;
            $item->unit_price = $count * 2;
            $count = $count + 1;

            $carrito[] = $item;
        }
        $preference->items = $carrito;


        $preference->back_urls = [
            'success' => route('mercadopago.success'),
            'failure' => route('mercadopago.failure'),
            'pending' => route('mercadopago.pending'),
        ];
        $preference->auto_return = 'approved'; // Redirige automáticamente al usuario después de un pago aprobado

        // Guarda la preferencia
        $save = $preference->save();

        // Obtiene el link de pago
        $paymentLink = $preference->init_point;
        //dd($carrito);//dd($preference);//echo $preference->id;

        if ($save) {
            $dato = [
                'public_key' => $public_key,
                'preference_id' =>  $preference->id,
                'url' => $preference->back_urls,
                'init_point' => $paymentLink
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

    //una vez pagado, el weehook mandara una notificacion 
    //con los datos a esta ruta para para poder el siguiente flujo 
    //PODRIAS CREAR UN WEBHOOK GENERAL QUE ES ESTE Y GUARDAR LOS DATOS SEGUNDA TIPO DE PAGO "pago o suscripcion"
    //OBS: PARA ACCEDER A LOS PAGOS REALES, UTILIZA LAS LLAVES DE PRDUCCION DE TU CUENTA DE PRUEBA
    public function success(Request $request)
    {
        dd($request->getContent());
    }

    public function failure()
    {
        return "error de pago";
    }

    public function pending()
    {
        return "Pago Pendiente";
    }

    //METODO PARA  CANCELAR UN PAGO (COMPRA DE PRODUCTO) DEVOLUCION 
    public function cancel(Request $request)
    {
        // ID del pago que deseas reembolsar
        $paymentId = '64200528550';

        // URL de la API de MercadoPago para realizar un reembolso
        $refundUrl = 'https://api.mercadopago.com/v1/payments/' . $paymentId . '/refunds';

        // Datos de autenticación (tu clave de acceso de MercadoPago)
        $accessToken = config('mercadopago.token');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post($refundUrl);

        dd($response);
    }
}
