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
                        <div class="card-header bg-dark text-white">Agregar Tipo</div>
                        <div class="card-body">
                            <form action="{{ route('tipo.save') }}" id="form-tipo" method="POST"
                                enctype="application/x-www-form-urlencoded">

                                @csrf

                                <div class="form-group my-2">

                                    <label for="nombre" class="my-2">Tipo</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Jugo personal - empanadas - pasteles">
                                    {{-- validacion con validate --}}
                                    @error('nombre')
                                        {{-- alerta de error --}}
                                        <span class="text-danger error-text nombre_error">{{ $message }}</span>
                                    @enderror
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
                        <div class="card-header bg-dark text-white">Lista Tipos</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($types as $type)
                                        <tr>
                                            <th scope="row">{{ $type->id }}</th>
                                            <td>{{ $type->nombre }}</td>
                                            <td>
                                                {{-- vinculamos el boton modal(producto.edit-product-modal) con el fomulario de todos los productos --}}
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#edit-type-modal" id="edit-type-btn"
                                                    data-id="{{ $type->id }}">Edit</button>
                                            </td>
                                            <td>
                                                <form action="{{ route('tipo.delete') }}" method="POST">
                                                    @csrf

                                                    @method('DELETE')
                                                    <input type="text" id="type_id" name="type_id"
                                                        value="{{ $type->id }}" hidden>
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        id="delete-type-btn" data-id="{{ $type->id }}">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- INCLUIMOS EL MODAL --}}
        @include('admin.tipo.edit-type-modal')
        </div>
    </section>
@endsection
