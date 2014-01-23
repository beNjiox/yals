<div class="panel panel-success">
  <div class="panel-heading">
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <h5>
                Total : <strong> <a href="/companies"> {{ $nb_companies }} {{ Str::plural("Company", $nb_companies) }} </a> </strong>
            </h5>
        </div>
    </div>
</div>
<div class="panel-body">
    <div class='row'>
        @if (count($companies) == 0)
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>No companies!</strong> <a href="/companies/create"> Add company </a>
        </div>
        @else
        @foreach ($companies as $company)
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
            <div class='well'>
                <h3> <a href='/companies/{{ $company["id"] }}'> {{{ $company['name'] }}} </a> </h3>
                <h4> {{ count($company['users']) }} {{ Str::plural("User", count($company['users'])) }}</h4>
                <hr>
                @if (isset($company['users']))
                    <ul>
                        @foreach ($company['users'] as $employee)
                            <li class='text-left'>
                                <a href="/users/{{$employee['id']}}">
                                    {{ $employee['username'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
</div>

