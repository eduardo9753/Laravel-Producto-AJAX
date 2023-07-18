{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProduct" >Open modal </button> --}}

<div class="modal fade" id="edit-juice-modal" tabindex="-1" aria-labelledby="edit-juice-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Jugo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('juice.update') }}" method="POST" enctype="application/x-www-form-urlencoded"
                    id="edit-juice-form">

                    {{-- METODO ACTUALIZAR --}}
                    @method('PUT')

                    {{-- TOKEN DE SEGURIDAD --}}
                    @csrf

                    <div class="form-group my-2">
                        <label for="nombre" class="my-2">Nombre</label>
                        <input type="text" id="id_juice" name="id_juice">
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            placeholder="Nombre del producto">
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
                                    placeholder="Precio">
                                {{-- alerta de error --}}
                                <span class="text-danger error-text precio_error"></span>
                            </div>
                        </div>
                    </div>

                    {{-- la imagen antigua --}}
                    <div class="mb-3">
                        <label for="product_name" class="col-form-label">Imagen Antigua</label>
                        <img src="" alt="" id="" class="img-tamanio img-old">
                    </div>

                    {{-- la imagen nueva --}}
                    <div class="mb-3">
                        <label for="imagen_update_juice" class="col-form-label">Imagen Nueva:</label>
                        <input type="file" class="form-control" accept="image/*" name="imagen_update_juice"
                            id="imagen_update_juice" placeholder="Another input">
                        {{-- alerta de error --}}
                        <span class="text-danger error-text imagen_update_juice_error"></span>
                    </div>
                    {{-- aqui donde se colocara la imagen para pre visualizar --}}
                    <div class="text-center my-3"> <img src="" id="img-preview-new" alt="Nueva imagen"
                            class="img-tamanio"></div>

                    <div class="form-group my-2">
                        <label for="descripcion" class="my-2">Descripcion Jugo</label>
                        <textarea name="descripcion" class="form-control" id="descripcion" cols="30" rows="5"></textarea>
                        {{-- alerta de error --}}
                        <span class="text-danger error-text descripcion_error"></span>
                    </div>

                    <div class="mb-3">
                        <div class="img-holder-update"></div>
                        <button type="submit" class="btn btn-dark">Actualizar Datos</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
