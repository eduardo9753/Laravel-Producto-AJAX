@extends('layout.app')


@section('navegador')
    @include('template.nav-admin')
@endsection


@section('main')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-5">
                    <div class="card">
                        <div class="card-header bg-dark text-white">Agregar nuevo Jugo</div>
                        <div class="card-body">
                            <form action="{{ route('juice.save') }}" id="form" method="POST"
                                enctype="application/x-www-form-urlencoded">

                                @csrf

                                <div class="form-group my-2">
                                    <label for="nombre" class="my-2">Nombre</label>
                                    <input type="text" name="count_juice" id="count_juice" value="{{ $juices->count() }}"
                                        hidden>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="jugo especial - torta helada">
                                    {{-- alerta de error --}}
                                    <span class="text-danger error-text nombre_error"></span>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label for="type_id" class="my-2">Tipo</label>
                                            <select name="type_id" id="type_id" class="form-select">
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->id }}">{{ $type->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label for="precio" class="my-2">Precio del Producto</label>
                                            <input type="text" class="form-control" name="precio" id="precio"
                                                placeholder="8.90">
                                            {{-- alerta de error --}}
                                            <span class="text-danger error-text precio_error"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group my-2">
                                    <label for="imagen" class="my-2">Subir Nueva foto</label>
                                    <input type="file" class="form-control" accept="image/*" id="imagen"
                                        name="imagen">
                                    {{-- alerta de error --}}
                                    <span class="text-danger error-text imagen_error"></span>
                                </div>
                                {{-- aqui donde se colocara la imagen para pre visualizar --}}
                                <div class="text-center my-3"> <img src="" id="img-preview" alt="Nueva imagen"
                                        class="img-tamanio"></div>

                                <div class="form-group my-2">
                                    <label for="descripcion" class="my-2">Descripcion Jugo</label>
                                    <textarea name="descripcion" class="form-control" id="descripcion" cols="30" rows="5"></textarea>
                                    {{-- alerta de error --}}
                                    <span class="text-danger error-text descripcion_error"></span>
                                </div>



                                <div class="my-2">
                                    <input type="submit" name="btn-guardar" value="Guardar" class="btn btn-success w-100">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 mt-5">
                    <div class="card">
                        <div class="card-header bg-dark text-white">Lista de Jugos</div>
                        {{-- AQUI SE VAN A CARGAR LOS DATOS CON VIA AJAX --}}
                        <div class="card-body" id="AllJuices">
                        </div>
                    </div>
                </div>
            </div>

            {{-- INCLUIMOS EL MODAL --}}
            @include('admin.jugo.edit-juice-modal')
        </div>
    </section>
@endsection
