{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProduct" >Open modal </button> --}}

<div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('product.update') }}" method="POST" enctype="application/x-www-form-urlencoded"
                    id="edit-form">

                    {{-- METODO ACTUALIZAR --}}
                    @method('PUT')

                    {{-- TOKEN DE SEGURIDAD --}}
                    @csrf

                    <div class="mb-3">
                        <input type="text" hidden id="pid" name="pid">
                        <label for="product_name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="product_name" name="product_name">
                        {{-- alerta de error --}}
                        <span class="text-danger error-text product_name_error"></span>
                    </div>

                    {{-- la imagen antigua --}}
                    <div class="mb-3">
                        <label for="product_name" class="col-form-label">Imagen Antigua</label>
                        <img src="" alt="" id="" class="img-tamanio img-old">
                    </div>

                    {{-- la imagen nueva --}}
                    <div class="mb-3">
                        <label for="product_image_update" class="col-form-label">Imagen Nueva:</label>
                        <input type="file" class="form-control" accept="image/*" name="product_image_update"
                            id="product_image_update" placeholder="Another input">
                        {{-- alerta de error --}}
                        <span class="text-danger error-text product_image_update_error"></span>
                    </div>
                    {{-- aqui donde se colocara la imagen para pre visualizar --}}
                    <div class="text-center my-3"> <img src="" id="img-preview-new" alt="Nueva imagen"
                            class="img-tamanio"></div>

                    <div class="mb-3">
                        <div class="img-holder-update"></div>
                        <button type="submit" class="btn btn-dark">Save Change</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
