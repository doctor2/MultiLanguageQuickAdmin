@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.projects.title')</h3>

    {!! Form::model($project, ['method' => 'PUT', 'route' => ['admin.projects.update', $project->id], 'files' => true]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <ul class="nav nav-tabs">
            <li class="nav-item active"><a data-toggle="tab" class="bg-aqua-active nav-link" href="#_en" id="en_link">EN</a></li>
            <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#_ru" id="ru_link">RU</a></li>
        </ul>
        <div class="panel-body" data-form>
            <div class="tab-content">
                @include ('admin.projects.form', ['suffix' => '_en', 'show' => 'active' ])

                @include ('admin.projects.form', ['suffix' => '_ru', 'show' => null ])
            </div>
            <h4>{{trans('quickadmin.qa_common_fields')}}</h4>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('year', trans('quickadmin.projects.fields.year').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('year', old('year'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('year'))
                        <p class="help-block">
                            {{ $errors->first('year') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('city_id', trans('quickadmin.projects.fields.city').'', ['class' => 'control-label']) !!}
                    {!! Form::select('city_id', $cities, old('city_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('city_id'))
                        <p class="help-block">
                            {{ $errors->first('city_id') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('preview_image', trans('quickadmin.projects.fields.preview'), ['class' => 'control-label']) !!}
                    @if(isset($project))
                        @if ($project->preview_image_full)
                            <img src="{{ $project->preview_image_full }}"  class="small_image">
                            {!! Form::file('preview_image', null, ['class' => 'form-control']) !!}
                        @else
                            <p>
                                <small>{{trans('quickadmin.qa_image_not_found')}}</small>
                                {!! Form::file('preview_image', null, ['class' => 'form-control']) !!}
                            </p>
                        @endif
                    @else
                        {!! Form::file('preview_image', null, ['class' => 'form-control']) !!}
                    @endif

                    <p class="help-block"></p>
                    @if($errors->has('preview_image'))
                        <p class="help-block">
                            {{ $errors->first('preview_image') }}
                        </p>
                    @endif
                </div>
            </div>
            @include ('admin.includes.active_order', ['item' =>  $project ?? null])

        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

