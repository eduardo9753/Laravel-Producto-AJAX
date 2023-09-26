<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use App\Models\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use MercadoPago\Payment;
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


    //cuando el cliente le de click al boton "Volver al sitio" 
    //guardaremos los datos de la comprar
    public function success(Request $request)
    {
        //puedes registrarlo en la base de datos
        if ($request->status === 'approved') {
            $save = Pay::create([
                'status' => $request->status,
                'pago_id' => $request->payment_id, //con esta id se puede gestionar los datos en mercado pago
                'tipo_pago' => 'Producto', //$request->payment_type
            ]);

            if ($save) {
                return redirect()->route('inicio.index')->with('pay', 'Se realizó el pago correctamente');
            } else {
                return redirect()->route('inicio.index')->with('nopay', 'No se realizó el pago correctamente');
            }
        }
        //else para las demos estados 
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
        // Configura tu clave secreta de MercadoPago
        $secretKey = config('mercadopago.token');

        // Define la cantidad a reembolsar (ajusta esto según tus necesidades)
        $amount = 10.0;

        // Construye la URL de la API de reembolso de MercadoPago
        $refundUrl = "https://api.mercadopago.com/v1/payments/$request->pago_id/refunds";

        // Realiza la solicitud HTTP para realizar el reembolso
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $secretKey,
            'Content-Type' => 'application/json',
        ])->post($refundUrl, [
            'amount' => $amount,
        ]);

        if ($response->successful()) {
            // Reembolso exitoso
            return response()->json(['message' => 'Reembolso exitoso'], 200);
        } else {
            // Hubo un error al realizar el reembolso
            return response()->json(['error' => $response->body()], $response->status());
        }
    }
}
