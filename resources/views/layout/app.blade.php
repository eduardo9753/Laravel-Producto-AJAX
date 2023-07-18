<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--ICONO DEL PROYECTO--}}
    <link rel="icon" type="image/png" href="{{ asset('img/logo/logo.jpeg') }}">

    {{-- CON ESTE COMANDO SE ARREGLO ERROR: 419 --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel | Ajax</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    {{-- LINK CSS --}}
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/colores.css') }}">
    <link rel="stylesheet" href="{{ asset('css/generales.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav-cliente.css') }}">

    {{-- LINK CSS CLIENTE--}}
    <link rel="stylesheet" href="{{ asset('css/cliente/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cliente/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cliente/contacto.css') }}">

    {{--LINK RESPONSIVE--}}
    <link rel="stylesheet" href="{{ asset('css/responsive/cliente.home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive/cliente.menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive/nav-cliente.css') }}">

</head>

<body class="antialiased">


    {{-- NAV --}}
    @yield('navegador')

    {{--HEADER--}}
    @yield('header')


    {{-- CUERPO --}}
    <main>
        @yield('main')
    </main>


    {{-- FOOTER --}}
    @yield('footer')

    <!-- CDN JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>


    <!--FILES JS-->
    <script src="{{ asset('js/ajaxJuice.js') }}"></script>
    <script src="{{ asset('js/ajaxSupply.js') }}"></script>
    <script src="{{ asset('js/ajaxCategory.js') }}"></script>
    <script src="{{ asset('js/ajaxProovedor.js') }}"></script>
    <script src="{{ asset('js/cargarImagen.js') }}"></script>
    <script src="{{ asset('js/cargarImagenEdit.js') }}"></script>

</body>

</html>
