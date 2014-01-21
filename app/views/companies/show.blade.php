@extends ('layouts.main')

@section ('content')

    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/companies">Companies</a></li>
      <li class="active">{{ $company['name'] }}</li>
    </ol>

    <div class="panel panel-info show-item">
          <div class="panel-heading">
            <div class="row">
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <h3 class="panel-title">{{ $company['name'] }}</h3>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
                    <a href="/companies/{{ $company['id'] }}" data-method='DELETE' data-confirm='Are you sure?'><i class='fa fa-times'></i></a>
                    &nbsp;
                    <a href="/companies/{{ $company['id'] }}/edit">
                      <i class='fa fa-edit'></i>
                    </a>
                </div>
            </div>
          </div>
          <div class="panel-body">
                <ul>
                    <li> ID: {{ $company['id'] }} </li>
                </ul>
          </div>
    </div>

@stop