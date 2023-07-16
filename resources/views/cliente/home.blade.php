@extends('layout.app')


@section('navegador')
    @include('template.nav-cliente')
@endsection



@section('header')
    <header class="" id="header-home">
        <div class="centrar-div">
            <h1 class="header-titulo">frutimanía</h1>
            <p class="header-parrafo">juguería y sanguchería</p>
        </div>
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
                        <p class="">ESPECIALISTAS EN: </p>
                        <p class="descripcion-parrafo">jugos</p>
                        <p class="descripcion-parrafo">sandwich</p>
                        <p class="descripcion-parrafo">pasteles</p>
                        <p class="descripcion-parrafo">Licuados especiales</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection



@section('footer')
   @include('template.footer')
@endsection
