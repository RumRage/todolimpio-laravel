@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Combo
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Combo</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('combos.update', $combo->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('combo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
