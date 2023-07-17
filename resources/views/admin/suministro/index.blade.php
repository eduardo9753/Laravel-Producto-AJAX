@extends('layout.app')


@section('navegador')
    @include('template.nav-admin')
@endsection


@section('main')
    <section id="supply">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-5">
                    <div class="card">
                        <div class="card-header bg-dark text-white">Add new Supply</div>
                        <div class="card-body">
                            <form action="{{ route('supply.save') }}" id="form-supply" method="POST"
                                enctype="application/x-www-form-urlencoded">

                                @csrf

                                <div class="form-group my-2">
                                    <label for="nombre" class="my-2">Nombre Suministro</label>
                                    <input type="text" name="count_supply" id="count_supply" value="{{ $supplies->count() }}" hidden>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Nombre del producto">
                                    {{-- alerta de error --}}
                                    <span class="text-danger error-text nombre_error"></span>
                                </div>


                                <div class="form-group my-2">
                                    <label for="precio" class="my-2">Precio del Producto</label>
                                    <input type="text" class="form-control" name="precio" id="precio"
                                        placeholder="Precio">
                                    {{-- alerta de error --}}
                                    <span class="text-danger error-text precio_error"></span>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label for="stock" class="my-2">Stock del Producto</label>
                                            <input type="text" class="form-control" name="stock" id="stock"
                                                placeholder="Stock">
                                            {{-- alerta de error --}}
                                            <span class="text-danger error-text stock_error"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label for="category_id" class="my-2">Categorias</label>
                                            <select name="category_id" id="category_id" class="form-select">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
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
                        <div class="card-header bg-dark text-white">All Supplies</div>
                        {{-- AQUI SE VAN A CARGAR LOS DATOS CON VIA AJAX --}}
                        <div class="card-body" id="AllSupplies">
                        </div>
                    </div>
                </div>
            </div>

            {{-- INCLUIMOS EL MODAL --}}
            @include('admin.suministro.edit-supply-modal')
        </div>
    </section>
@endsection
