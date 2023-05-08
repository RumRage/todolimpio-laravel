@extends('layouts.app')

@section('template_title')
    Historial
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Historial') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('historials.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                    @foreach ($historials as $historial)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $historial->combo->nombre }}</td>
											<td>{{ $historial->nombre }}</td>
											<td>{{ $historial->telefono }}</td>
											<td>{{ $historial->direccion }}</td>
											<td>{{ $historial->precio }}</td>
											<td>{{ $historial->descuento }}</td>
											<td>{{ $historial->precio_final }}</td>
											<td>{{ $historial->metodo_pago }}</td>
											<td>{{ $historial->estado }}</td>

                                            <td>
                                                <form action="{{ route('historials.destroy',$historial->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('historials.show',$historial->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('historials.edit',$historial->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $historials->links() !!}
            </div>
        </div>
    </div>
@endsection
