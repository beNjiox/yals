@extends ('layouts.main')

@section ('content')

@section('title', $company['name'] . " " . trans('yals.company'))
@section('breadcrumbs', Breadcrumbs::render('companies.show', $company['name'] ))

<div class="panel panel-info show-item">
  <div class="panel-heading">
    <div class="row">
      <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
        <h3 class="panel-title">{{ $company['name'] }}</h3>
      </div>
      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
        <a href="{{ to_companies($company['id']) }}" data-method='DELETE' data-confirm='@lang("yals.confirm_delete")'><i class='fa fa-times'></i></a>
        &nbsp;
        <a href="{{ to_companies($company['id'], 'edit')}}">
          <i class='fa fa-edit'></i>
        </a>
      </div>
    </div>
  </div>
  <div class="panel-body">
    <h4 clas='text-center'>
      {{{ $company['catchphrase'] }}}
      <small> {{{ $company['description'] }}} </small>
    </h4>

    <ul>
      <li> @lang('yals.label_company_email') : <a href="mailo:{{ $company['email'] }}">{{ $company['email'] }}</a> </li>
      <li> @lang('yals.label_website_url'): <a href="{{ $company['website_url'] }}">{{ $company['website_url'] }}</a> </li>
    </ul>

    <h4>
      {{ count($company['users']) }} {{ Str::plural('User', count($company['users'])) }} in the company.
    </h4>

    <ul>
      @foreach ($company['users'] as $user)
      <li> {{ link_to_route('companies.users.show', $user['username'], [ $user['company_id'], $user['id'] ] ) }} - <a href="mailo:{{ $user['email'] }}">{{ $user['email'] }}</a> <small> (#{{$user['id']}}) </small> </li>
      @endforeach
    </ul>

  </div>
</div>

@stop