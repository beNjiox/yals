<div class="form-group">
    {{ Form::label("username", 'Username', [ 'class' => 'control-label col-sm-2']) }}
    <div class='col-sm-10'>
        {{ Form::text("username", null, [ 'style' => 'width:50%', 'placeholder' => 'username' ]) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label("email", 'Email', [ 'class' => 'control-label col-sm-2']) }}
    <div class='col-lg-10'>
        {{ Form::text("email", null, [ 'style' => 'width:50%', 'placeholder' => 'email' ]) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label("company_id", 'Company', [ 'class' => 'control-label col-sm-2']) }}
    <div class='col-lg-10'>
        {{ Form::select("company_id",
                         array('default' => 'Select a company') + $companies,
                         isset($user) && isset($user['company_id']) && !is_null($user['company_id']) ? $user['company_id'] : 'default'
         ) }}
    </div>
</div>

