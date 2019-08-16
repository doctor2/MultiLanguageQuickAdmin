@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.settings.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.settings.fields.name_en')</th>
                            <td field-key='name_en'>{{ $setting->name_en }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.settings.fields.name_ru')</th>
                            <td field-key='name_ru'>{{ $setting->name_ru }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.settings.fields.key')</th>
                            <td field-key='key'>{{ $setting->key }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.settings.fields.order')</th>
                            <td field-key='order'>{{ $setting->order }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.settings.fields.description')</th>
                            <td field-key='description'>{!! $setting->description !!}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.settings.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


