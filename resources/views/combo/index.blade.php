@extends('layouts.app')

@section('template_title')
    Combo
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Combo') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('combos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Servicios</th>
										<th>Nombre</th>
										<th>Precio</th>
										<th>Descuento</th>
										<th>Precio Final</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($combos as $combo)
                                        <tr>
                                            <td>{{ ++$i }}</td>
											<td>{{ implode(', ', $combo->servicios->pluck('nombre')->toArray()) }}</td>
											<td>{{ $combo->nombre }}</td>
											<td>{{ $combo->precio }}</td>
											<td>{{ $combo->descuento }}</td>
											<td>{{ $combo->precio_final }}</td>

                                            <td>
                                                <form action="{{ route('combos.destroy',$combo->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('combos.show',$combo->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('combos.edit',$combo->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $combos->links() !!}
            </div>
        </div>
    </div>
@endsection
