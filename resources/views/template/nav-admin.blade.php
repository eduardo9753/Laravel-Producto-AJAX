<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" target="_blank" href="{{ route('inicio.index') }}">Menu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home.index') }}">Casa</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Gestión Suministros
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('provider.index') }}" class="dropdown-item">Proveedores</a>
                        </li>
                        <li><a href="{{ route('category.index') }}" class="dropdown-item">Categorias</a>
                        </li>
                        <li><a href="{{ route('supply.index') }}" class="dropdown-item">Suministros</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Gestión Jugos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('tipo.index') }}" class="dropdown-item">Tipos</a></li>
                        <li><a href="{{ route('juice.index') }}" class="dropdown-item">Jugos</a></li>
                    </ul>
                </li>

                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Gestión Mercadopago
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('admin.mercadopago.index') }}" class="dropdown-item">Pagos</a></li>
                        <li><a href="{{ route('admin.mercadopago.suscription.index') }}"
                                class="dropdown-item">Suscripciones</a></li>
                    </ul>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('caja.index') }}">Caja</a>
                </li>

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <input type="submit" class="btn btn-danger" value="Salir">
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
