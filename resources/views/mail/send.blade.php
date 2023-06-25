@extends('layout.app')


@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto mt-5">
                <div class="card">
                    <div class="card-header text-white bg-dark text-center">
                        <h1 class="titulo-correo">Recuperar Contraseña</h1>
                        <p>Hola, te saluda el Equipo de Soporte MiAgroPeru</p>
                        <p>Pör favor dar click al siguiente enlace para poder recuperar su Contraseña</p>
                        <p>Atte: Soporte MiAgroPeru</p>
                    </div>
                    <div class="card-body">
                        <a target="_blank" href="{{ route('mail.recover') }}">Recuperar Mi Contraseña</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
