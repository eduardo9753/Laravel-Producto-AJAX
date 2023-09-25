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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('supply.index') }}">Suministros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.index') }}">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('provider.index') }}">Proveedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('juice.index') }}">Jugos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('caja.index') }}">Caja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tipo.index') }}">Tipos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.mercadopago.index') }}">Pagos</a>
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
