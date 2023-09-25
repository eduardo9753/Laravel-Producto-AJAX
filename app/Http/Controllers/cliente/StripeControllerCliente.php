<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class StripeControllerCliente extends Controller
{
    //
    public function index()
    {
        return view('cliente/stripe/index');
    }



    public function session()
    {
        $productItems = [];
        //LLAMAMOS AL ARCHIVO "stripe.php"  UE CREAMOS EN config
        \Stripe\Stripe::setApiKey(config('stripe.secret'));

        $count = 1;
        while ($count <= 3) {
            $product_name = 'Producto' . $count;
            $total = $count;
            $quantity = $count;

            $two0 = "00";
            $unit_amount = $total . $two0;

            $productItems[] = [
                'price_data' => [
                    'product_data' => [
                        'name' => $product_name,
                    ],
                    'currency'     => 'PEN',
                    'unit_amount'  => $unit_amount,
                ],
                'quantity' => $quantity
            ];
            $count = $count + 1;
        }

        $checkoutSession = \Stripe\Checkout\Session::create([
            'line_items'            => [$productItems],
            'mode'                  => 'payment',
            'allow_promotion_codes' => true,
            'metadata'              => [
                'user_id' => "0001"
            ],
            'customer_email' => "anthony.anec@gmail.com", //$user->email,
            'success_url' => route('stripe.success', ['productItems' => $productItems]),
            'cancel_url'  => route('stripe.cancel'),
        ]);

        //$save = Category::create(['nombre' => 'categoria despues de pagar 2']);
        return redirect()->away($checkoutSession->url);
    }


    public function success(Request $request)
    {
        return "Orde comprada";
        //dd($request);
    }

    public function cancel()
    {
        return "Lo sentimos, hubo un error con tu pago";
    }
}
