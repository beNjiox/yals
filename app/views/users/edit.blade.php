@extends ('layouts.main')

@section ('content')

  @section('breadcrumbs', Breadcrumbs::render('companies.users.edit', $user))
  @include ('partials/_errors_form')

{{ Form::model($user,
      [
      'method' => 'PATCH',
      'class'  => 'form-horizontal',
      'role'   => 'form',
      'route'  => [ "companies.users.update", $user['company_id'], $user['id'] ]
    ])
}}

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit user</h3>
        </div>
        <div class="panel-body">
            @include ('users/_form')

            <div class="form-group">
                {{ Form::label("company_id", 'Company', [ 'class' => 'control-label col-sm-2']) }}
                <div class='col-lg-10'>
                    {{ Form::select("company_id",
                                     array('default' => 'Select a company') + $companies,
                                     isset($user) && isset($user['company_id']) && !is_null($user['company_id']) ? $user['company_id'] : 'default'
                     ) }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {{ Form::submit('Edit this user', [ 'class' => 'btn btn-primary' ]) }}
                </div>
            </div>

        </div>
    </div>

{{ Form::close() }}
@stop