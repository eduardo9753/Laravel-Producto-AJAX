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
                        <p class="descripcion-parrafo">51 999 888 777</p>
                        <p class="descripcion-parrafo">Av san lazaro 345</p>
                        <p class="descripcion-parrafo">Referencia al Grifo de Año nuevo</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3903.7272831553178!2d-77.04296142593863!3d-11.924057739626079!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105d18a44cd752b%3A0x61d72d40b9498a3!2sFRUTIMAN%C3%8DA!5e0!3m2!1ses!2spe!4v1689716075258!5m2!1ses!2spe"
        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
@endsection



@section('footer')
    @include('template.footer')
@endsection
