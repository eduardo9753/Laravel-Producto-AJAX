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
                <div class="menu-fondo imagen-jugo-personal centrar-div">
                    <h3>jugos-personal</h3>
                </div>
            </a>

            <a href="{{ route('menu.show', ['id'=>1]) }}">
                <div class="menu-fondo imagen-jugo-jarra centrar-div">
                    <h3>jugos-Jarra</h3>
                </div>
            </a>

            <a href="{{ route('menu.show', ['id'=>2]) }}">
                <div class="menu-fondo imagen-pastel-dulce centrar-div">
                    <h3>pasteles-dulces</h3>
                </div>
            </a>

            <a href="{{ route('menu.show', ['id'=>3]) }}">
                <div class="menu-fondo imagen-pastel-salado centrar-div">
                    <h3>pasteles-salados</h3>
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