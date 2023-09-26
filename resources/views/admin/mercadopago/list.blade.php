@extends('layout.app')


@section('navegador')
    @include('template.nav-admin')
@endsection


@section('main')
    <section>
        <div class="container mt-5">
            <div class="row">
                <div class="card">
                    <div class="card-header bg-dark text-white">Lista de Suscripciones</div>
                    {{-- AQUI SE VAN A CARGAR LOS DATOS CON VIA AJAX --}}
                    <div class="card-body" id="">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Codigo Pago</th>
                                    <th scope="col">Tipo Pago</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Cancelar Suscripcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $pay)
                                    <tr>
                                        <th scope="row">{{ $pay->id }}</th>
                                        <td>{{ $pay->status }}</td>
                                        <td>{{ $pay->pago_id }}</td>
                                        <td>{{ $pay->tipo_pago }}</td>
                                        <td>{{ $pay->created_at }}</td>
                                        <td>
                                            <form action="{{ route('admin.mercadopago.suscripcion.cancel') }}" method="POST">
                                                @csrf
                                                <input type="text" name="pago_id" value="{{ $pay->pago_id }}">
                                                <button type="submit">Reembolsar</button>
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
    </section>
@endsection
