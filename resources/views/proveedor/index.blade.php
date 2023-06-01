@extends('layout.app')


@section('main')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-5">
                    <div class="card">
                        <div class="card-header bg-dark text-white">Add new Provider</div>
                        <div class="card-body">
                            <form action="{{ route('provider.save') }}" id="form-provider" method="POST"
                                enctype="application/x-www-form-urlencoded">

                                @csrf

                                <div class="form-group my-2">
                                    <label for="nombre" class="my-2">Nombre Provedor</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Nombre del producto">
                                    {{-- alerta de error --}}
                                    <span class="text-danger error-text nombre_error"></span>
                                </div>

                                <div class="form-group my-2">
                                    <label for="descripcion" class="my-2">Descripcion Provedor</label>
                                    <textarea name="descripcion" class="form-control" id="descripcion" cols="30" rows="5"></textarea>
                                    {{-- alerta de error --}}
                                    <span class="text-danger error-text descripcion_error"></span>
                                </div>

                                <div class="my-2">
                                    <input type="submit" name="btn-guardar" value="Enviar" class="btn btn-success w-100">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 mt-5">
                    <div class="card">
                        <div class="card-header bg-dark text-white">All Providers</div>
                        {{-- AQUI SE VAN A CARGAR LOS DATOS CON VIA AJAX --}}
                        <div class="card-body" id="AllProviders">
                        </div>
                    </div>
                </div>
            </div>

            {{-- INCLUIMOS EL MODAL --}}
            @include('proveedor.edit-providers-modal')
        </div>
    </section>
@endsection
