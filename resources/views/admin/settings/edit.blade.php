@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.settings.title')</h3>

    {!! Form::model($setting, ['method' => 'PUT', 'route' => ['admin.settings.update', $setting->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <ul class="nav nav-tabs">
            <li class="nav-item active"><a data-toggle="tab" class="bg-aqua-active nav-link" href="#_en" id="en_link">EN</a></li>
            <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#_ru" id="ru_link">RU</a></li>
        </ul>
        <div class="panel-body">
            <div class="tab-content">
                @include ('admin.settings.form', ['suffix' => '_en', 'show' => 'active' ])

                @include ('admin.settings.form', ['suffix' => '_ru', 'show' => null ])
            </div>
            <h4>{{trans('quickadmin.qa_common_fields')}}</h4>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('key', trans('quickadmin.settings.fields.key').'', ['class' => 'control-label']) !!}
                    {!! Form::text('key', old('key'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('key'))
                        <p class="help-block">
                            {{ $errors->first('key') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('quickadmin.settings.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('order', trans('quickadmin.settings.fields.order').'', ['class' => 'control-label']) !!}
                    {!! Form::number('order', old('order'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('order'))
                        <p class="help-block">
                            {{ $errors->first('order') }}
                        </p>
                    @endif
                </div>
            </div>


        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

