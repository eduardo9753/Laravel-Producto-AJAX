@if ($juices)
    <div class="row">
        @foreach ($juices as $juice)
            <div class="col-md-4">
                <div class="media mb-4">
                    <img src="{{ asset('productos/' . $juice->imagen) }}" alt="{{ $juice->imagen }}"
                        class="d-flex align-self-lg-start rounded mr-3 img-tamanio">

                    <div class="media-body">
                        <h2 class="mt-0 font-16">{{ $juice->nombre }}</h2>
                        <div class="btn-group">
                            {{-- vinculamos el boton modal(juiceo.edit-juice-modal) con el fomulario de todos los juiceos --}}
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit-juice-modal"
                                id="edit-juice-btn" data-id="{{ $juice->id }}">Edit</button>

                            <button class="btn btn-sm btn-danger" id="delete-juice-btn"
                                data-id="{{ $juice->id }}">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="card">
        <div class="card-header bg-dark text-white">Sin Jugos</div>
    </div>
@endif
