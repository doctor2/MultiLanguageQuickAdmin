@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.cities.title')</h3>

    {!! Form::open(['method' => 'POST', 'route' => ['admin.cities.store']]) !!}


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>

        <ul class="nav nav-tabs">
            <li class="nav-item active"><a data-toggle="tab" class="bg-aqua-active nav-link" href="#_en" id="en_link">EN</a></li>
            <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#_ru" id="ru_link">RU</a></li>
        </ul>
        <div class="panel-body">
            <div class="tab-content">
                @include ('admin.cities.form', ['suffix' => '_en', 'show' => 'active' ])

                @include ('admin.cities.form', ['suffix' => '_ru', 'show' => null ])
            </div>
            <h4>{{trans('quickadmin.qa_common_fields')}}</h4>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('key', trans('quickadmin.cities.fields.key').'', ['class' => 'control-label']) !!}
                    {!! Form::text('key', old('key'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('key'))
                        <p class="help-block">
                            {{ $errors->first('key') }}
                        </p>
                    @endif
                </div>
            </div>
            @include ('admin.includes.active_order', ['item' =>  $city ?? null])

        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

