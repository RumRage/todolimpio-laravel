@extends('layouts.app')

@section('template_title')
    {{ $agenda->name ?? "{{ __('Show') Agenda" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Agenda</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('agendas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Combo Id:</strong>
                            {{ $agenda->combo_id }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $agenda->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $agenda->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $agenda->direccion }}
                        </div>
                        <div class="form-group">
                            <strong>Precio:</strong>
                            {{ $agenda->precio }}
                        </div>
                        <div class="form-group">
                            <strong>Descuento:</strong>
                            {{ $agenda->descuento }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Final:</strong>
                            {{ $agenda->precio_final }}
                        </div>
                        <div class="form-group">
                            <strong>Metodo Pago:</strong>
                            {{ $agenda->metodo_pago }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $agenda->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
