@if ($providers)
    <div class="row">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($providers as $provider)
                    <tr>
                        <th scope="row">{{ $provider->id }}</th>
                        <td>{{ $provider->nombre }}</td>
                        <td>{{ $provider->descripcion }}</td>

                        <td>
                            {{-- vinculamos el boton modal(producto.edit-product-modal) con el fomulario de todos los productos --}}
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#edit-provider-modal" id="edit-provider-btn"
                                data-id="{{ $provider->id }}">Edit</button>
                        </td>

                        <td>
                            <button class="btn btn-sm btn-danger" id="delete-provider-btn"
                                data-id="{{ $provider->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@else
    <div class="card">
        <div class="card-header bg-dark text-white">Sin Proovedores</div>
    </div>
@endif
