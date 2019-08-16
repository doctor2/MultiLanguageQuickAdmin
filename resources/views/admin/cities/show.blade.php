@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.cities.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.cities.fields.name_en')</th>
                            <td field-key='name_en'>{{ $city->name_en }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.cities.fields.name_ru')</th>
                            <td field-key='name_ru'>{{ $city->name_ru }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.cities.fields.key')</th>
                            <td field-key='key'>{{ $city->key }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.cities.fields.order')</th>
                            <td field-key='order'>{{ $city->order }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.cities.fields.active')</th>
                            <td field-key='active'>{{ Form::checkbox("active", 1, $city->active == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">

<li role="presentation" class="active"><a href="#projects" aria-controls="projects" role="tab" data-toggle="tab">Projects</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">

<div role="tabpanel" class="tab-pane active" id="projects">
<table class="table table-bordered table-striped {{ count($projects) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.projects.fields.title_en')</th>
                        <th>@lang('quickadmin.projects.fields.additional_en')</th>
                        <th>@lang('quickadmin.projects.fields.year')</th>
                        <th>@lang('quickadmin.projects.fields.order')</th>
                        <th>@lang('quickadmin.projects.fields.active')</th>
                        <th>@lang('quickadmin.projects.fields.city')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($projects) > 0)
            @foreach ($projects as $project)
                <tr data-entry-id="{{ $project->id }}">
                    <td field-key='title'>{{ $project->title }}</td>
                                <td field-key='additional'>{!! $project->additional !!}</td>
                                <td field-key='year'>{{ $project->year }}</td>
                                <td field-key='order'>{{ $project->order }}</td>
                                <td field-key='active'>{{ Form::checkbox("active", 1, $project->active == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='city'>{{ $project->city->key ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('project_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.projects.restore', $project->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('project_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.projects.perma_del', $project->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('project_view')
                                    <a href="{{ route('admin.projects.show',[$project->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('project_edit')
                                    <a href="{{ route('admin.projects.edit',[$project->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('project_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.projects.destroy', $project->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="11">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.cities.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


