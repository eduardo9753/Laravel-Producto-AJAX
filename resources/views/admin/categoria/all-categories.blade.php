@if ($categories)
    <div class="row">
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
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">p-{{ $category->id }}</th>
                        <td>{{ $category->nombre }}</td>

                        <td>
                            {{-- vinculamos el boton modal(producto.edit-product-modal) con el fomulario de todos los productos --}}
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#edit-category-modal" id="edit-category-btn"
                                data-id="{{ $category->id }}">Edit</button>
                        </td>

                        <td>
                            <button class="btn btn-sm btn-danger" id="delete-category-btn"
                                data-id="{{ $category->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@else
    <div class="card">
        <div class="card-header bg-dark text-white">Sin Categorias</div>
    </div>
@endif
