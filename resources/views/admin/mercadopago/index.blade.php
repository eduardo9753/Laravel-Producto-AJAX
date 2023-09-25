@extends('layout.app')


@section('navegador')
    @include('template.nav-admin')
@endsection


@section('main')
    <section>
        <div class="container mt-5">
            <div class="row">
                <div class="card">
                    <div class="card-header bg-dark text-white">Lista de Jugos</div>
                    {{-- AQUI SE VAN A CARGAR LOS DATOS CON VIA AJAX --}}
                    <div class="card-body" id="">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Codigo Pago</th>
                                    <th scope="col">Tipo Pago</th>
                                    <th scope="col">Reembolsar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $pay)
                                    <tr>
                                        <th scope="row">{{ $pay->id }}</th>
                                        <td>{{ $pay->status }}</td>
                                        <td>{{ $pay->pago_id }}</td>
                                        <td>{{ $pay->tipo_pago }}</td>
                                        <td>
                                            <form action="{{ route('admin.mercadopago.reembolso',['paymentId' => $pay->pago_id]) }}" method="POST">
                                                @csrf
                                               
                                                <button type="submit" class="btn btn-danger">Relizar Reembolso</button>
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
