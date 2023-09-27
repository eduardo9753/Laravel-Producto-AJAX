<!--
<body>
    <a mp-mode="dftl"
        href="https://www.mercadopago.com.pe/subscriptions/checkout?preapproval_plan_id=2c9380848ab2cb05018aba814d4c05a0"
        name="MP-payButton" class='blue-ar-l-rn-none'>Suscribirme</a>
    <script type="text/javascript">
        (function() {
            function $MPC_load() {
                window.$MPC_loaded !== true && (function() {
                    var s = document.createElement("script");
                    s.type = "text/javascript";
                    s.async = true;
                    s.src = document.location.protocol + "//secure.mlstatic.com/mptools/render.js";
                    var x = document.getElementsByTagName('script')[0];
                    x.parentNode.insertBefore(s, x);
                    window.$MPC_loaded = true;
                })();
            }
            window.$MPC_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPC_load) : window
                .addEventListener('load', $MPC_load, false)) : null;
        })();
        /*
              // to receive event with message when closing modal from congrants back to site
              function $MPC_message(event) {
                // onclose modal ->CALLBACK FUNCTION
               // !!!!!!!!FUNCTION_CALLBACK HERE Received message: {event.data} preapproval_id !!!!!!!!
              }
              window.$MPC_loaded !== true ? (window.addEventListener("message", $MPC_message)) : null; 
              */
    </script>

</body>
-->
@extends('layout.app')


@section('navegador')
    @include('template.nav-cliente')
@endsection



@section('header')
    <header class="" id="header-contacto">
        <h1 class="header-contacto-titulo">Pagar Suscripcion Con MercadoPago</h1>
    </header>
@endsection


@section('main')
    <section class="" id="descripcion">
        <div class="contenedor">
            <div class="descripcion-flex">
                <img class="descripcion-imagen" src="{{ asset('img/logo/logo.jpeg') }}" alt="">

                <div class="descripcion-caja">
                    <div class="centrar-div">
                        <h1 class="descripcion-titulo">Pagar Suscripcion</h1>


                        <div class="col-md-12 col-lg-4">
                            <div class="summary">
                                <form action="{{ route('mercadopago.suscription.pay') }}" id="form-cart-venta-suscripcion">
                                    @csrf
                                    <button class="btn btn-primary btn-lg btn-block" id="checkout-btn">Checkout</button>
                                </form>

                                {{--<a mp-mode="dftl" href="https://www.mercadopago.com.pe/subscriptions/checkout?preapproval_plan_id=2c9380848ab2cb05018aba814d4c05a0" name="MP-payButton" class='blue-ar-l-rn-none'>Suscribirme</a>
--}}
                                <a id="link-suscripcion-mercadopago" >Pagar Suscripcion</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    
    <script src="{{ asset('js/cliente/mercadoPagoSuscripcion.js') }}"></script>
@endsection



@section('footer')
    @include('template.footer')
@endsection

