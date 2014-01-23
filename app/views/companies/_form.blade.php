<div class="form-group">
    {{ Form::label("name", trans('yals.label_company_name'), [ 'class' => 'control-label col-sm-2']) }}
    <div class='col-lg-10'>
        {{ Form::text("name", null, [ 'style' => 'width:50%', 'placeholder' => trans('yals.placeholder_company_name') ]) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label("website_url", trans('yals.label_website_url'), [ 'class' => 'control-label col-sm-2']) }}
    <div class='col-sm-10'>
        {{ Form::text("website_url", null, [ 'style' => 'width:50%', 'placeholder' => trans('yals.placeholder_website_url') ]) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label("description", trans('yals.label_company_description'), [ 'class' => 'control-label col-sm-2']) }}
    <div class='col-sm-10'>
        {{ Form::textarea("description",
                          null,
                          [ 'style' => 'width:50%', 'placeholder' => trans('yals.placeholder_company_description') ]) }}
    </div>
</div>

