@extends('layouts.app')

@section('template_title')
    Agenda
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Agenda de servicios') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('agendas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Agendar nuevo servicio') }}
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
										<th>Nombre</th>
										<th>Telefono</th>
										<th>Direccion</th>
                                        <th>Fecha</th>
                                        <th>Combos</th>
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
                                            
											<td>{{ $agenda->nombre }}</td>
											<td>{{ $agenda->telefono }}</td>
											<td>{{ $agenda->direccion }}</td>
                                            <td>{{ \Carbon\Carbon::parse($agenda->fecha_hora)->format('d/m/Y h:i A') }}</td>
                                            <td>{{ implode(', ', $agenda->combos->pluck('nombre')->toArray()) }}</td>
											<td>{{ $agenda->precio }}</td>
											<td>{{ $agenda->descuento }}</td>
											<td>{{ $agenda->precio_final }}</td>
											<td>{{ $agenda->metodo_pago }}</td>
											<td>{{ $agenda->estado }}</td>

                                            <td>
                                                <form action="{{ route('agendas.destroy',$agenda->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('agendas.show',$agenda->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('agendas.edit',$agenda->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>                                                
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                                <form action="{{ route('agendas.cancelado', $agenda->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-check"></i> {{ __('Cancelado') }}</button>
                                                </form>
                                                
                                                <form action="{{ route('agendas.hecho', $agenda->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-check"></i> {{ __('Hecho') }}</button>
                                                </form>

                                            </td>
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
