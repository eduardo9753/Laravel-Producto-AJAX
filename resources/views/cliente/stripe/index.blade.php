@extends('layout.app')


@section('navegador')
    @include('template.nav-cliente')
@endsection



@section('header')
    <header class="" id="header-contacto">
        <h1 class="header-contacto-titulo">contacto</h1>
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
                        <form action="{{ route('stripe.session') }}" method="POST">
                            <div class="form-group">
                                @csrf
                                <label for="">Pagar</label>
                                <input type="submit" id="checkout-live-button" value="Pagar" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection



@section('footer')
    @include('template.footer')
@endsection
