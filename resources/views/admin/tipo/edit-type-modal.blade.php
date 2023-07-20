{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-category-modal" >Open modal </button> --}}

<div class="modal fade" id="edit-type-modal" tabindex="-1" aria-labelledby="edit-type-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tipo.update') }}" method="POST" enctype="application/x-www-form-urlencoded"
                    id="edit-type-form">

                    {{-- METODO ACTUALIZAR --}}
                    @method('PUT')

                    {{-- TOKEN DE SEGURIDAD --}}
                    @csrf

                    <div class="form-group my-2">
                        <label for="nombre" class="my-2">Tipo</label>
                        <input type="text" id="id_tipo" name="id_tipo" hidden>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            placeholder="Jugo personal - empanadas - pasteles">
                        {{-- alerta de error --}}
                        <span class="text-danger error-text nombre_error"></span>
                    </div>

                    <div class="my-2">
                        <input type="submit" name="btn-guardar" value="Guardar" class="btn btn-success w-100">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
