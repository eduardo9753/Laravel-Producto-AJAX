@extends('layout.app')


@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto mt-5">
                <div class="card">
                    <div class="card-header text-white bg-dark text-center">
                        <h1>Recuperar Contraseña</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('mail.send') }}" method="POST">

                            {{-- token de seguridad --}}
                            @csrf

                            <!--MENSAJE-->
                            @if (session('mensaje'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('mensaje') }}
                                </div>
                            @endif
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="email">Digite su Correo Porfavor</label>
                                <input type="email" name="email" id="email" class="form-control" />
                                {{-- VALIDACION CON VALIDATE --}}
                                @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Submit button -->
                            <input type="submit" class="btn btn-primary btn-block mb-4" value="Recuperar Contraseña">

                            <!-- Register buttons -->
                            <div class="text-center">
                                <p>Ingresar <a href="{{ route('login.index') }}">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
