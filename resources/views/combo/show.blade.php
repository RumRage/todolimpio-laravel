@extends('layouts.app')

@section('template_title')
    {{ $combo->name ?? "{{ __('Show') Combo" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Combo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('combos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Servicio Id:</strong>
                            {{ $combo->servicio_id }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $combo->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Precio:</strong>
                            {{ $combo->precio }}
                        </div>
                        <div class="form-group">
                            <strong>Descuento:</strong>
                            {{ $combo->descuento }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Final:</strong>
                            {{ $combo->precio_final }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
