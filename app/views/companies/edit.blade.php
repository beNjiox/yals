@extends ('layouts.main')

@section ('content')

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
            <h3 class="panel-title">Edit company</h3>
        </div>
        <div class="panel-body">
            @include ('companies/_form')

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {{ Form::submit('Edit this company', [ 'class' => 'btn btn-primary' ]) }}
                </div>
            </div>

        </div>
    </div>

{{ Form::close() }}
@stop