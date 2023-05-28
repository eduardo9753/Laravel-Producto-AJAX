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
                                    <label for="name" class="my-2">Nombre Producto</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name"
                                        placeholder="Nombre del producto">
                                    {{-- alerta de error --}}
                                    <span class="text-danger error-text product_name_error"></span>
                                </div>

                                <div class="form-group my-2">
                                    <label for="file" class="my-2">Subir Nueva foto</label>
                                    <input type="file" class="form-control" accept="image/*" id="product_image"
                                        name="product_image">
                                    {{-- alerta de error --}}
                                    <span class="text-danger error-text product_image_error"></span>
                                </div>
                                {{-- aqui donde se colocara la imagen para pre visualizar --}}
                                <div class="text-center my-3"> <img src="" id="img-preview" alt="Nueva imagen"
                                        class="img-tamanio"></div>

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
