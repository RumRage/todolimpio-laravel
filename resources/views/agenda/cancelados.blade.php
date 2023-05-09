@extends('layouts.app')

@section('template_title')
    Cancelado
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Cancelado') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('agendas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Combos</th>
										<th>Nombre</th>
										<th>Telefono</th>
										<th>Direccion</th>
										<th>Precio</th>
										<th>Descuento</th>
										<th>Precio Final</th>
										<th>Metodo Pago</th>
										<th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agendas as $agenda)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ implode(', ', $agenda->combo->pluck('nombre')->toArray()) }}</td>
											<td>{{ $agenda->nombre }}</td>
											<td>{{ $agenda->telefono }}</td>
											<td>{{ $agenda->direccion }}</td>
											<td>{{ $agenda->precio }}</td>
											<td>{{ $agenda->descuento }}</td>
											<td>{{ $agenda->precio_final }}</td>
											<td>{{ $agenda->metodo_pago }}</td>
											<td>{{ $agenda->estado }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $agendas->links() !!}
            </div>
        </div>
    </div>
@endsection
