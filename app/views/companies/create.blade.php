@extends ('layouts.main')

@section ('content')

@section('breadcrumbs', Breadcrumbs::render('companies.create'))
@section('title', trans('yals.companies_title_create'))
@include ('partials/_errors_form')

{{ Form::open([ 'url' => 'companies', 'class' => 'form-horizontal', 'role' => 'form' ]) }}

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> @lang("yals.company_add") </h3>
        </div>
        <div class="panel-body">
            @include ('companies/_form')
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {{ Form::submit( trans("yals.company_add") , [ 'class' => 'btn btn-primary' ]) }}
                </div>
            </div>

        </div>
    </div>

{{ Form::close() }}
@stop