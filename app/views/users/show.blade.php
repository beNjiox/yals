@extends ('layouts.main')

@section ('content')

    @section('breadcrumbs', Breadcrumbs::render('companies.users.show', $user, $company))
    @section('title', $user['username'] . " from " . $company['name'])

    <div class="panel panel-info show-user">
          <div class="panel-heading">
            <div class="row">
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <h3 class="panel-title">{{ $user['username'] }}</h3>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
                    <a href="{{ route('companies.users.destroy', [ $user['company_id'], $user['id'] ]) }}"
                       data-method='DELETE' data-confirm='Are you sure?'><i class='fa fa-times'></i></a>
                    &nbsp;
                    <a href="{{ route('companies.users.edit', [ $user['company_id'], $user['id'] ]) }}">
                      <i class='fa fa-edit'></i>
                    </a>
                </div>
            </div>
          </div>
          <div class="panel-body">
                <ul>
                    <li> ID: {{ $user['id'] }} </li>
                    <li> Email: {{ $user['email'] }} </li>
                    <li> Company:
                      @if ($user['company'])
                        <a href="/companies/{{ $user['company']['id'] }}">{{ $user['company']['name'] }}</a>
                      @else
                        none.
                      @endif
                    </li>
                </ul>
          </div>
    </div>

    @include ('users/_comments_form')
    @include ('users/_list_comments')
@stop