<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CON ESTE COMANDO SE ARREGLO ERROR: 419 --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel | Ajax</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    {{-- LINK CSS --}}
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

</head>

<body class="antialiased">

    @auth
        {{-- NAVEGACION --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('home.index') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product.index') }}">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category.index') }}">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('provider.index') }}">Providers</a>
                        </li>

                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <input type="submit" class="btn-salir" value="Salir">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @endauth


    {{-- CUERPO --}}
    <main>
        @yield('main')
    </main>


    {{-- FOOTER --}}

    <!-- CDN JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>


    <!--FILES JS-->
    <script src="{{ asset('js/ajaxProduct.js') }}"></script>
    <script src="{{ asset('js/ajaxCategory.js') }}"></script>
    <script src="{{ asset('js/ajaxProovedor.js') }}"></script>
    <script src="{{ asset('js/cargarImagen.js') }}"></script>
    <script src="{{ asset('js/cargarImagenEdit.js') }}"></script>

</body>

</html>
