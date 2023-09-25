<div>
    <input type="checkbox" id="btn-menu">
    <label class="contenedor-menu" for="btn-menu"> {{-- ESTE DIV SE CAMBIO POR UN LABEL PARA TENER EL "for=""" --}}
        <div class="contenido-menu">
            <nav>
                <ul class="menu-item">
                    <li class="item"><a href="{{ route('inicio.index') }}">Inicio</a></li>
                    <li class="item"><a href="{{ route('menu.index') }}">El Menú</a></li>
                    <li class="item"><a href="{{ route('stripe.index') }}">Pago Stripe</a></li>
                    <li class="item"><a href="{{ route('mercadopago.index') }}">Pago MercadoPago</a></li>
                    <li class="item"><a href="{{ route('mercadopago.suscription.index') }}">Pago MercadoPago Suscripcion</a></li>
                    <li class="item"><a href="{{ route('contacto.index') }}">Contacto</a></li>
                </ul>
            </nav>
            <label for="btn-menu"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-x"
                    width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                    <path d="M10 10l4 4m0 -4l-4 4" />
                </svg></label>
        </div>
    </label>{{-- ESTE DIV SE CAMBIO POR UN LABEL PARA TENER EL "for=""" --}}

    <nav id="navegador">
        <div class="contenedor">
            <div class="navegador-flex">

                <label for="btn-menu">
                    <div class="logo">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2"
                            width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00bfd8"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 6l16 0" />
                            <path d="M4 12l16 0" />
                            <path d="M4 18l16 0" />
                        </svg>
                        <p>FRUTIMANIA</p>
                    </div>
                </label>

                <div class="caja-img">
                    <a href="{{ route('inicio.index') }}">
                        <img src="{{ asset('img/logo/logo.jpeg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </nav>
</div>
