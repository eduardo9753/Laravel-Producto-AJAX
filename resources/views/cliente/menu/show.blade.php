@extends('layout.app')


@section('navegador')
    @include('template.nav-cliente')
@endsection



@section('header')
    <header class="" id="header-menu">
        <h1 class="header-menu-titulo">frutimanía - productos</h1>
    </header>
@endsection


@section('main')
    <section class="" id="menu-productos">
        <div class="contenedor">

            <div class="d-flex justify-content-around">
                @foreach ($types as $type)
                    <div class="pr-3 pt-3"><a href="{{ route('menu.show', ['id' => $type->id]) }}">{{ $type->nombre }}</a></div>
                @endforeach
            </div>
            <div class="menu-productos-grilla">
                @foreach ($juices as $juice)
                    <div class="menu-productos-caja">
                        <img src="{{ asset('productos/' . $juice->imagen) }}" alt="{{ $juice->imagen }}" class="">

                        <div class="menu-productos-descripcion">
                            <div class="menu-productos-flex">
                                <p class="nombre">{{ $juice->nombre }}</p>
                                <p class="precio">S/{{ $juice->precio }}</p>
                            </div>
                            <p class="informacion">{{ $juice->descripcion }}</p>
                            <a href="https://wa.me/51952955205?text=Quisiera más información del producto - Nombre:{{ $juice->nombre }} - {{ $juice->precio }} - {{ $juice->descripcion }}"
                                target="_blank" class="boton">Pedir</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection



@section('footer')
    @include('template.footer')
@endsection
