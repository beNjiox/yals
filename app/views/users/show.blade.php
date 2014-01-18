@extends ('layouts.main')

@section ('content')

    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/users">Users</a></li>
      <li class="active">{{ $user['username'] }}</li>
    </ol>

    <div class="panel panel-info show-user">
          <div class="panel-heading">
            <div class="row">
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <h3 class="panel-title">{{ $user['username'] }}</h3>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
                    <a href="/users/{{ $user['id'] }}" data-method='DELETE' data-confirm='Are you sure?'><i class='fa fa-times'></i></a>
                    &nbsp;
                    <a href="/users/{{ $user['id'] }}/edit">
                      <i class='fa fa-edit'></i>
                    </a>
                </div>
            </div>
          </div>
          <div class="panel-body">
                <ul>
                    <li> ID: {{ $user['id'] }} </li>
                    <li> Email: {{ $user['email'] }} </li>
                </ul>
          </div>
    </div>

@stop