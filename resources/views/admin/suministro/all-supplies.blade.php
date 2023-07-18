@if ($supplies)
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
                @foreach ($supplies as $supply)
                    <tr>
                        <th scope="row">p-{{ $supply->id }}</th>
                        <td>{{ $supply->nombre }}</td>

                        <td>
                            {{-- vinculamos el boton modal(producto.edit-product-modal) con el fomulario de todos los productos --}}
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#edit-supply-modal" id="edit-supply-btn"
                                data-id="{{ $supply->id }}">Edit</button>
                        </td>

                        <td>
                            <button class="btn btn-sm btn-danger" id="delete-supply-btn"
                                data-id="{{ $supply->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@else
    <div class="card">
        <div class="card-header bg-dark text-white">Sin Suministros</div>
    </div>
@endif
