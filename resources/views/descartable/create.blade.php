@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Descartable
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Descartable</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('descartables.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('descartable.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
