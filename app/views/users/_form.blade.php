<div class="form-group">
    {{ Form::label("username", trans('yals.label_username'), [ 'class' => 'control-label col-sm-2']) }}
    <div class='col-sm-10'>
        {{ Form::text("username", null, [ 'style' => 'width:50%', 'placeholder' => trans('yals.placeholder_username') ]) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label("email", trans('yals.label_email'), [ 'class' => 'control-label col-sm-2']) }}
    <div class='col-lg-10'>
        {{ Form::text("email", null, [ 'style' => 'width:50%', 'placeholder' => trans('yals.placeholder_email') ]) }}
    </div>
</div>


