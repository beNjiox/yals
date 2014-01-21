@extends('layouts.main')

@section('content')

    <a type="button" class="btn btn-primary btn-xs" href='/companies/create'>
        <i class='fa fa-plus'></i>&nbsp;Add Company
    </a>

    @if (count($companies) == 0)
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>OOps</strong> There is no companies.
        </div>

    @else
        <ul class="list-group">
        @foreach ($companies as $company)
            <li class="list-group-item index-item-row">
                <div class="row">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                        <a href="/companies/{{ $company['id'] }}"> {{ $company['name'] }} </a>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right action-items-row">
                        <a href="/companies/{{ $company['id'] }}" data-method='DELETE' data-confirm='Are you sure?'><i class='fa fa-times'></i></a>
                        &nbsp;
                        <a href="/companies/{{ $company['id'] }}/edit"><i class='fa fa-edit'></i></a>
                        &nbsp;
                        <a href="/companies/{{ $company['id'] }}"><i class='fa fa-eye'></i></a>
                    </div>
                </div>
            </li>
        @endforeach
        </ul>
    @endif

@stop
