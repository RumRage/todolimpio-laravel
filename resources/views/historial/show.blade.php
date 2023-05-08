@extends('layouts.app')

@section('template_title')
    {{ $historial->name ?? "{{ __('Show') Historial" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Historial</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('historials.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Combo Id:</strong>
                            {{ $historial->combo_id }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $historial->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $historial->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $historial->direccion }}
                        </div>
                        <div class="form-group">
                            <strong>Precio:</strong>
                            {{ $historial->precio }}
                        </div>
                        <div class="form-group">
                            <strong>Descuento:</strong>
                            {{ $historial->descuento }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Final:</strong>
                            {{ $historial->precio_final }}
                        </div>
                        <div class="form-group">
                            <strong>Metodo Pago:</strong>
                            {{ $historial->metodo_pago }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $historial->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
