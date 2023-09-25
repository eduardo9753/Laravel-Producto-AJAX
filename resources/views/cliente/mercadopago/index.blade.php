@extends('layout.app')


@section('navegador')
    @include('template.nav-cliente')
@endsection



@section('header')
    <header class="" id="header-contacto">
        <h1 class="header-contacto-titulo">Pagar Con MercadoPago</h1>
    </header>
@endsection


@section('main')
    <section class="" id="descripcion">
        <div class="contenedor">
            <div class="descripcion-flex">
                <img class="descripcion-imagen" src="{{ asset('img/logo/logo.jpeg') }}" alt="">

                <div class="descripcion-caja">
                    <div class="centrar-div">
                        <h1 class="descripcion-titulo">Pagar</h1>


                        <div class="col-md-12 col-lg-4">
                            <div class="summary">
                                <form action="{{ route('mercadopago.pay') }}" id="form-cart-venta">
                                    @csrf
                                    <button class="btn btn-primary btn-lg btn-block" id="checkout-btn">Checkout</button>
                                </form>

                                <div id="wallet_container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    
    <script src="{{ asset('js/cliente/mercadoPago.js') }}"></script>
@endsection



@section('footer')
    @include('template.footer')
@endsection
