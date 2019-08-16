<div id="{{$suffix}}" class="tab-pane {{$show}}">
    <br />
    <div class="row">
        <div class="col-xs-12 form-group">
            {!! Form::label( 'name' . $suffix, trans('quickadmin.cities.fields.name' . $suffix), ['class' => 'control-label']) !!}
            {!! Form::text( 'name' . $suffix, null, ['class' => 'form-control']) !!}
            <p class="help-block"></p>
            @if($errors->has('name'. $suffix))
                <p class="help-block">
                    {{ $errors->first('name'. $suffix) }}
                </p>
            @endif
        </div>
    </div>
</div>
