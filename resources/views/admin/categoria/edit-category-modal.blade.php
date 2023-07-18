{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-category-modal" >Open modal </button> --}}

<div class="modal fade" id="edit-category-modal" tabindex="-1" aria-labelledby="edit-category-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('category.update') }}" method="POST" enctype="application/x-www-form-urlencoded"
                    id="edit-category-form">

                    {{-- METODO ACTUALIZAR --}}
                    @method('PUT')

                    {{-- TOKEN DE SEGURIDAD --}}
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="my-2">Nombre Categoria</label>
                        <input type="text" id="id_category" name="id_category" hidden>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            placeholder="Nombre de la Categoria">
                        {{-- alerta de error --}}
                        <span class="text-danger error-text nombre_error"></span>
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
