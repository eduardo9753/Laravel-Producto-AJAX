@if ($products)
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4">
                <div class="media mb-4">
                    <img src="/storage/files/{{ $product->product_image }}" alt="{{ $product->product_image }}"
                        class="d-flex align-self-lg-start rounded mr-3 img-tamanio">

                    <div class="media-body">
                        <h2 class="mt-0 font-16">{{ $product->product_name }}</h2>
                        <div class="btn-group">
                            {{-- vinculamos el boton modal(producto.edit-product-modal) con el fomulario de todos los productos --}}
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editProduct"
                                id="editBtn" data-id="{{ $product->id }}">Edit</button>

                            <button class="btn btn-sm btn-danger" id="deleteBtn"
                                data-id="{{ $product->id }}">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="card">
        <div class="card-header bg-dark text-white">Empty Products</div>
    </div>
@endif
