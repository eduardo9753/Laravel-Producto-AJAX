{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-provider-modal" >Open modal </button> --}}

<div class="modal fade" id="edit-provider-modal" tabindex="-1" aria-labelledby="edit-provider-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Proovedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('provider.update') }}" method="POST" enctype="application/x-www-form-urlencoded"
                    id="edit-provider-form">

                    {{-- METODO ACTUALIZAR --}}
                    @method('PUT')

                    {{-- TOKEN DE SEGURIDAD --}}
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="my-2">Nombre Proveedor</label>
                        <input type="text" id="id_provider" name="id_provider" hidden>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            placeholder="Nombre del producto">
                        {{-- alerta de error --}}
                        <span class="text-danger error-text nombre_error"></span>
                    </div>

                    {{-- la imagen antigua --}}
                    <div class="mb-3">
                        <label for="descripcion" class="my-2">Descripcion Proveedor</label>
                        <textarea name="descripcion" class="form-control" id="descripcion" cols="30" rows="5"></textarea>
                        {{-- alerta de error --}}
                        <span class="text-danger error-text descripcion_error"></span>
                    </div>


                    <div class="mb-3">
                        <button type="submit" class="btn btn-dark">Actualizar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
