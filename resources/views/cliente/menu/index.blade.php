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

            @foreach ($types as $type)
                <a href="{{ route('menu.show', ['id' => $type->id]) }}">
                    <div class="menu-fondo imagen-jugo-personal centrar-div">
                        <h3>{{ $type->nombre }}</h3>
                    </div>
                </a>
            @endforeach

        </div>
    </section>
@endsection


@section('footer')
    @include('template.footer')
@endsection
