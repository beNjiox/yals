<div class="form-group">
    {{ Form::label("Email", 'email', [ 'class' => 'control-label col-sm-2']) }}
    <div class='col-lg-10'>
        {{ Form::text("email", null, [ 'style' => 'width:50%', 'placeholder' => 'email' ]) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label("Username", 'username', [ 'class' => 'control-label col-sm-2']) }}
    <div class='col-sm-10'>
        {{ Form::text("username", null, [ 'style' => 'width:50%', 'placeholder' => 'username' ]) }}
    </div>
</div>

