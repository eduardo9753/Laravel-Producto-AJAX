@extends('layout.app')


@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto mt-5">
                <div class="card">
                    <div class="card-header text-white bg-dark text-center">
                        <h1>Login-Frutimanía</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('login.store') }}" method="POST">

                            {{-- token de seguridad --}}
                            @csrf

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="email">Email address</label>
                                <input type="email" name="email" id="email" class="form-control" />
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control" />
                            </div>

                            <!-- 2 column grid layout for inline styling -->
                            <div class="row mb-4">
                                <div class="col d-flex justify-content-center">
                                    <!-- Checkbox -->
                                    <div class="form-check">
                                        <label class="form-check-label" for="remenber"> Remember me </label>
                                        <input class="form-check-input" type="checkbox" name="remenber" id="remenber" />

                                    </div>
                                </div>

                                <div class="col">
                                    <!-- Simple link -->
                                    <a href="{{ route('mail.index') }}">Olvide mi Contraseña</a>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <input type="submit" class="btn btn-primary btn-block mb-4" value="Ingresar">

                            <!-- Register buttons -->
                            <div class="text-center">
                                <p>Quiero registrarme <a href="{{ route('register.index') }}">Register</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
