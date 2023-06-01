@extends('layout.app')


@section('main')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-5">
                    <div class="card">
                        <div class="card-header bg-dark text-white">Add new Product</div>
                        <div class="card-body">
                            <form action="{{ route('product.save') }}" id="form" method="POST"
                                enctype="application/x-www-form-urlencoded">

                                @csrf

                                <div class="form-group my-2">
                                    <label for="product_name" class="my-2">Nombre Producto</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name"
                                        placeholder="Nombre del producto">
                                    {{-- alerta de error --}}
                                    <span class="text-danger error-text product_name_error"></span>
                                </div>

                                <div class="form-group my-2">
                                    <label for="product_image" class="my-2">Subir Nueva foto</label>
                                    <input type="file" class="form-control" accept="image/*" id="product_image"
                                        name="product_image">
                                    {{-- alerta de error --}}
                                    <span class="text-danger error-text product_image_error"></span>
                                </div>
                                {{-- aqui donde se colocara la imagen para pre visualizar --}}
                                <div class="text-center my-3"> <img src="" id="img-preview" alt="Nueva imagen"
                                        class="img-tamanio"></div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label for="provider_id" class="my-2">Proovedor</label>
                                            <select name="provider_id" id="provider_id" class="form-select">
                                                @foreach ($providers as $provider)
                                                    <option value="{{ $provider->id }}">{{ $provider->nombre }}</option>
                                                @endforeach
                                            </select>
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
                                            <label for="precio" class="my-2">Precio del Producto</label>
                                            <input type="text" class="form-control" name="precio" id="precio"
                                                placeholder="Precio">
                                            {{-- alerta de error --}}
                                            <span class="text-danger error-text precio_error"></span>
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
                        <div class="card-header bg-dark text-white">All Product</div>
                        {{-- AQUI SE VAN A CARGAR LOS DATOS CON VIA AJAX --}}
                        <div class="card-body" id="AllProducts">
                        </div>
                    </div>
                </div>
            </div>

            {{-- INCLUIMOS EL MODAL --}}
            @include('producto.edit-product-modal')
        </div>
    </section>
@endsection
