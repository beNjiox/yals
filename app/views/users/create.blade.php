@extends ('layouts.main')

@section ('content')

@include ('partials/_errors_form')

{{ Form::open([ 'url' => 'users', 'class' => 'form-horizontal', 'role' => 'form' ]) }}

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Add a new user</h3>
        </div>
        <div class="panel-body">
            @include ('users/_form')
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {{ Form::submit('Add a New User', [ 'class' => 'btn btn-primary' ]) }}
                </div>
            </div>

        </div>
    </div>

{{ Form::close() }}
@stop