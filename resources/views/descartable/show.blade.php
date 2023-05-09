@extends('layouts.app')

@section('template_title')
    {{ $descartable->name ?? "{{ __('Show') Descartable" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Descartable</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('descartables.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $descartable->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $descartable->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Precio:</strong>
                            {{ $descartable->precio }}
                        </div>
                        <div class="form-group">
                            <strong>Proveedor:</strong>
                            {{ $descartable->proveedor }}
                        </div>
                        <div class="form-group">
                            <strong>Stock:</strong>
                            {{ $descartable->stock }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
