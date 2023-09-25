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
            {{-- MENSAJE EL PAGO FUE CORRECTO --}}
            @if (session('pay'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Obs:</strong> {{ session('pay') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- MENSAJE EL PAGO FUE CORRECTO --}}
            @if (session('nopay'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Obs:</strong> {{ session('nopay') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

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
