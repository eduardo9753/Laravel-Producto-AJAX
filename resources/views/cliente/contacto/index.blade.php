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
                        <h1 class="descripcion-titulo">somos frutimanía</h1>
                        <p class="">CONTACTANOS: </p>
                        <p class="descripcion-parrafo">966 990 328</p>
                        <p class="descripcion-parrafo">Jr. Neptuno Mz 9-Lt 88 A </p>
                        <p class="descripcion-parrafo">Referencia al costado de comercial vega</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3903.727168053407!2d-77.04345072599392!3d-11.924065739626174!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105d1ceae0c8405%3A0x1340ec7e385b8a91!2sVega%20Market%20A%C3%B1o%20Nuevo!5e0!3m2!1ses!2spe!4v1689882735342!5m2!1ses!2spe"
        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
@endsection



@section('footer')
    @include('template.footer')
@endsection
