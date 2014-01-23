@extends ('layouts.main')

@section ('content')

@section('title', "Edit " . $company['name'] . " " . trans('yals.company'))
@section('breadcrumbs', Breadcrumbs::render('companies.edit', $company ))

@include ('partials/_errors_form')

{{ Form::model($company,
      [
      'method' => 'PATCH',
      'class'  => 'form-horizontal',
      'role'   => 'form',
      'route'  => [ "companies.update", $company['id'] ]
    ])
}}

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">@lang('yals.edit_company')</h3>
        </div>
        <div class="panel-body">
            @include ('companies/_form')

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {{ Form::submit(trans('yals.edit_company'), [ 'class' => 'btn btn-primary' ]) }}
                </div>
            </div>

        </div>
    </div>

{{ Form::close() }}
@stop