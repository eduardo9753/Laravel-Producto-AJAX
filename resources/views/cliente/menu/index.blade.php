@extends('layout.app')


@section('navegador')
    @include('template.nav-cliente')
@endsection



@section('header')
    <header class="" id="header-menu">
        <h1 class="header-menu-titulo">el menú</h1>
    </header>
@endsection


@section('main')
    <section class="margen-arriba" id="menu">
        <div class="contenedor">
           

            <a href="{{ route('menu.show', ['id'=>1]) }}">
                <div class="menu-fondo imagen-jugo centrar-div">
                    <h3>jugos</h3>
                </div>
            </a>

            <a href="{{ route('menu.show', ['id'=>2]) }}">
                <div class="menu-fondo imagen-pastel centrar-div">
                    <h3>pasteles</h3>
                </div>
            </a>

            <a href="{{ route('menu.show', ['id'=>3]) }}">
                <div class="menu-fondo imagen-sandwich centrar-div">
                    <h3>sandwich</h3>
                </div>
            </a>

            <a href="{{ route('menu.show', ['id'=>4]) }}">
                <div class="menu-fondo imagen-promocion centrar-div">
                    <h3>promociones</h3>
                </div>
            </a>
        </div>
    </section>
@endsection


@section('footer')
   @include('template.footer')
@endsection