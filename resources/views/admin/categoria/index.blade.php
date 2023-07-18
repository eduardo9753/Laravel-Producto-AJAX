@extends('layout.app')


@section('navegador')
    @include('template.nav-admin')
@endsection


@section('main')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-5">
                    <div class="card">
                        <div class="card-header bg-dark text-white">Agregar nueva Categoria</div>
                        <div class="card-body">
                            <form action="{{ route('category.save') }}" id="form-category" method="POST"
                                enctype="application/x-www-form-urlencoded">

                                @csrf

                                <div class="form-group my-2">
                                    <input type="text" name="count_category" id="count_category" value="{{ $categories->count() }}" hidden>
                                    <label for="nombre" class="my-2">Nombre Categoria</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Nombre de la Categoria">
                                    {{-- alerta de error --}}
                                    <span class="text-danger error-text nombre_error"></span>
                                </div>

                                <div class="my-2">
                                    <input type="submit" name="btn-guardar" value="Guardar" class="btn btn-success w-100">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

               
                <div class="col-md-6 mt-5">
                    <div class="card">
                        <div class="card-header bg-dark text-white">LIsta de Categorias</div>
                        {{-- AQUI SE VAN A CARGAR LOS DATOS CON VIA AJAX --}}
                        <div class="card-body" id="AllCategories">
                        </div>
                    </div>
                </div>
            </div>

            {{-- INCLUIMOS EL MODAL --}}
            @include('admin.categoria.edit-category-modal')
        </div>
    </section>
@endsection
