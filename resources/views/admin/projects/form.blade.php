<div id="{{$suffix}}" class="tab-pane {{$show}}">
    <br/>
    <div class="row">
        <div class="col-xs-12 form-group">
            {!! Form::label('title' . $suffix, trans('quickadmin.projects.fields.title'. $suffix) , ['class' => 'control-label']) !!}
            {!! Form::text('title' . $suffix, null, ['class' => 'form-control']) !!}
            <p class="help-block"></p>
            @if($errors->has('title'. $suffix))
                <p class="help-block">
                    {{ $errors->first('title'. $suffix) }}
                </p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 form-group">
            {!! Form::label( 'additional' . $suffix, trans('quickadmin.projects.fields.additional' . $suffix), ['class' => 'control-label']) !!}
            {!! Form::textarea( 'additional' . $suffix, null, ['class' => 'form-control','rows' => 3]) !!}
            <p class="help-block"></p>
            @if($errors->has('additional'. $suffix))
                <p class="help-block">
                    {{ $errors->first('additional'. $suffix) }}
                </p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 form-group">
            @php
                $multiKey =  'additional_multi' . $suffix;
            @endphp
            @if(old( $multiKey) or !empty($project))
                @foreach(old($multiKey) ? old($multiKey) : $project->$multiKey as $additional_multi)
                    <div data-parentId>
                        <label for="{{$multiKey}}[]" class="control-label"> {{trans('quickadmin.projects.fields.additional_multi'. $suffix)}}</label>
                        <input name="{{$multiKey}}[]" data-value type="text" style="width:450px;"
                               value="{{$additional_multi}}"/>
                        <a style="color:red;" data-delete-field href="#">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-minus" aria-hidden="true"></i>
                            </button>
                        </a>
                        <a style="color:green;" data-add-field href="#">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </a>
                    </div>
                @endforeach
            @else
                <div data-parentId>
                    <label for="{{$multiKey}}[]" class="control-label">{{trans('quickadmin.projects.fields.additional_multi'. $suffix)}}</label>
                    <input name="{{$multiKey}}[]" data-value type="text" style="width:450px;" value=""/>
                    <a style="color:red;" data-delete-field href="#">
                        <button class="btn btn-primary btn-sm"><i class="fa fa-minus" aria-hidden="true"></i></button>
                    </a>
                    <a style="color:green;" data-add-field href="#">
                        <button class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </a>
                </div>
            @endif
            <p class="help-block"></p>
            @if($errors->has($multiKey))
                <p class="help-block">
                    {{ $errors->first($multiKey) }}
                </p>
            @endif
        </div>
    </div>

</div>
