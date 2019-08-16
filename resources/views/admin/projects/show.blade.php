@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.projects.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.projects.fields.title_en')</th>
                            <td field-key='title_en'>{{ $project->title_en }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.projects.fields.title_ru')</th>
                            <td field-key='title_ru'>{{ $project->title_ru }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.projects.fields.additional_en')</th>
                            <td field-key='additional_en'>{!! $project->additional_en !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.projects.fields.additional_ru')</th>
                            <td field-key='additional_ru'>{!! $project->additional_ru !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.projects.fields.additional_multi_en')</th>
                            <td field-key='additional_multi_en'>
                                @foreach($project->additional_multi_en as $multi)
                                    {{$multi}} <br>
                                @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.projects.fields.additional_multi_ru')</th>
                            <td field-key='additional_multi_ru'>@foreach($project->additional_multi_ru as $multi)
                                    {{$multi}} <br>
                                @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.projects.fields.city')</th>
                            <td field-key='city'>{{ $project->city->key ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.projects.fields.year')</th>
                            <td field-key='year'>{{ $project->year }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.projects.fields.preview')</th>
                            <td field-key='preview'><img src="{{ $project->preview_image_full }}"  class="small_image"></td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.projects.fields.order')</th>
                            <td field-key='order'>{{ $project->order }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.projects.fields.active')</th>
                            <td field-key='active'>{{ Form::checkbox("active", 1, $project->active == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.projects.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


