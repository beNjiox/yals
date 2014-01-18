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
        </div>
    </div>

{{ Form::close() }}
@stop