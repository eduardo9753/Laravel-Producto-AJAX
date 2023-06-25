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
                        <form action="{{ route('mail.store') }}" method="POST">

                            {{-- token de seguridad --}}
                            @csrf

                            <!--MENSAJE-->
                            @if (session('mensaje'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('mensaje') }}
                                </div>
                            @endif
                            <!-- Email input -->

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="email">Digite su Correo Porfavor</label>
                                <input type="email" name="email" id="form2Example1" class="form-control" />

                                {{-- validacion con validate --}}
                                @error('email')
                                    {{-- alerta de error --}}
                                    <span class="text-danger error-text nombre_error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control" />

                                {{-- validacion con validate --}}
                                @error('password')
                                    {{-- alerta de error --}}
                                    <span class="text-danger error-text nombre_error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="password_confirmation">Password Confirmation</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control" />

                                {{-- validacion con validate --}}
                                @error('password_confirmation')
                                    {{-- alerta de error --}}
                                    <span class="text-danger error-text nombre_error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Submit button -->
                            <input type="submit" class="btn btn-primary btn-block mb-4" value="Recuperar Contraseña">

                            <!-- Register buttons -->
                            <div class="text-center">
                                <p>Logearse <a href="{{ route('login.index') }}">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
