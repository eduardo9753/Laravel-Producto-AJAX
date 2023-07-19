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
                        <div class="card-header bg-dark text-white">Agregar Caja</div>
                        <div class="card-body">
                            <form action="{{ route('caja.save') }}" id="form-caja" method="POST"
                                enctype="application/x-www-form-urlencoded">

                                @csrf

                                <div class="form-group my-2">

                                    <label for="egreso" class="my-2">egreso</label>
                                    <input type="text" class="form-control" id="egreso" name="egreso"
                                        placeholder="30">
                                    {{-- validacion con validate --}}
                                    @error('egreso')
                                        {{-- alerta de error --}}
                                        <span class="text-danger error-text nombre_error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group my-2">

                                    <label for="ingreso" class="my-2">ingreso</label>
                                    <input type="text" class="form-control" id="ingreso" name="ingreso"
                                        placeholder="120">
                                    {{-- validacion con validate --}}
                                    @error('ingreso')
                                        {{-- alerta de error --}}
                                        <span class="text-danger error-text nombre_error">{{ $message }}</span>
                                    @enderror
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
                        <div class="card-header bg-dark text-white">Lista Caja</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">egreso</th>
                                        <th scope="col">ingreso</th>
                                        <th scope="col">fecha</th>
                                        <th scope="col">final</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($boxes as $box)
                                        @php
                                            if ($box->egreso < $box->ingreso) {
                                                $final = $box->ingreso - $box->egreso;
                                                $alert = 'text-success';
                                            } else {
                                                $final = $box->ingreso - $box->egreso;
                                                $alert = 'text-danger';
                                            }
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $box->id }}</th>
                                            <td>{{ $box->egreso }}</td>
                                            <td>{{ $box->ingreso }}</td>
                                            <td>{{ $box->fecha }}</td>
                                            <td><span class="{{ $alert }}">{{ $final }}</span></td>
                                            <td>
                                                <form action="{{ route('caja.delete') }}" method="POST">
                                                    @csrf

                                                    @method('DELETE')
                                                    <input type="text" id="caja_id" name="caja_id"
                                                        value="{{ $box->id }}" hidden>
                                                    <button type="submit" class="btn btn-sm btn-danger" id="delete-box-btn"
                                                        data-id="{{ $box->id }}">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- INCLUIMOS EL MODAL --}}
        @include('admin.categoria.edit-category-modal')
        </div>
    </section>
@endsection
