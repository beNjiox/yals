@extends ('layouts.main')

@section ('content')

@include ('partials/_errors_form')

{{ Form::model($user,
      [
      'method' => 'PATCH',
      'class'  => 'form-horizontal',
      'role'   => 'form',
      'route'  => [ "users.update", $user['id'] ]
    ])
}}

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit user</h3>
        </div>
        <div class="panel-body">
            @include ('users/_form')

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {{ Form::submit('Edit this user', [ 'class' => 'btn btn-primary' ]) }}
                </div>
            </div>

        </div>
    </div>

{{ Form::close() }}
@stop