{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-category-modal" >Open modal </button> --}}

<div class="modal fade" id="edit-supply-modal" tabindex="-1" aria-labelledby="edit-supply-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Suministros</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('supply.update') }}" id="edit-supply-form" method="POST"
                    enctype="application/x-www-form-urlencoded">

                    {{-- METODO ACTUALIZAR --}}
                    @method('PUT')

                    {{-- TOKEN DE SEGURIDAD --}}
                    @csrf

                    <div class="form-group my-2">
                        <label for="nombre" class="my-2">Nombre Suministro</label>
                        <input type="text" hidden id="supply_id" name="supply_id">
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            placeholder="Nombre del producto">
                        {{-- alerta de error --}}
                        <span class="text-danger error-text nombre_error"></span>
                    </div>


                    <div class="form-group my-2">
                        <label for="precio" class="my-2">Precio del Producto</label>
                        <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio">
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
                        <input type="submit" name="btn-guardar" value="Actualizar" class="btn btn-success w-100">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
