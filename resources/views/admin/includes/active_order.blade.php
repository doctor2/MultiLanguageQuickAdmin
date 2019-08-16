<div class="row">
    <div class="col-xs-12 form-group">
        {!! Form::label('active', trans('quickadmin.qa_active').'', ['class' => 'control-label']) !!}
        {!! Form::hidden('active', 0) !!}
        {!! Form::checkbox('active', 1, old("active") ? old("active") : (!empty($item) ? $item->active : true), []) !!}
        <p class="help-block"></p>
        @if($errors->has('active'))
            <p class="help-block">
                {{ $errors->first('active') }}
            </p>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-xs-12 form-group">
        {!! Form::label( 'order', trans('quickadmin.qa_order'), ['class' => 'control-label']) !!}
        {!! Form::number( 'order', old("order") ? old("order") : (!empty($item) ? $item->order : 10), ['class' => 'form-control', 'placeholder' => '']) !!}
        <p class="help-block"></p>
        @if($errors->has('order'))
            <p class="help-block">
                {{ $errors->first('order') }}
            </p>
        @endif
    </div>
</div>
