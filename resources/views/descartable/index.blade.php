@extends('layouts.app')

@section('template_title')
    Descartable
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Descartable') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('descartables.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Nombre</th>
										<th>Descripcion</th>
										<th>Precio</th>
										<th>Proveedor</th>
										<th>Stock</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($descartables as $descartable)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $descartable->nombre }}</td>
											<td>{{ $descartable->descripcion }}</td>
											<td>{{ $descartable->precio }}</td>
											<td>{{ $descartable->proveedor }}</td>
											<td>{{ $descartable->stock }}</td>

                                            <td>
                                                <form action="{{ route('descartables.destroy',$descartable->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('descartables.show',$descartable->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('descartables.edit',$descartable->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $descartables->links() !!}
            </div>
        </div>
    </div>
@endsection
