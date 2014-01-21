<div class="form-group">
    {{ Form::label("name", 'Company name', [ 'class' => 'control-label col-sm-2']) }}
    <div class='col-lg-10'>
        {{ Form::text("name", null, [ 'style' => 'width:50%', 'placeholder' => 'name' ]) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label("website_url", 'Website URL', [ 'class' => 'control-label col-sm-2']) }}
    <div class='col-sm-10'>
        {{ Form::text("website_url", null, [ 'style' => 'width:50%', 'placeholder' => 'e.g www.google.com' ]) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label("description", 'Description', [ 'class' => 'control-label col-sm-2']) }}
    <div class='col-sm-10'>
        {{ Form::textarea("description", null, [ 'style' => 'width:50%', 'placeholder' => 'Company\'s description' ]) }}
    </div>
</div>

