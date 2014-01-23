@extends('layouts.main')

@section('content')

    @section('title')
        @lang('yals.companies_title')
    @stop
    @section('breadcrumbs', Breadcrumbs::render('companies'))

    <a type="button" class="btn btn-primary btn-xs" href="{{ to_companies('create') }}">
        <i class='fa fa-plus'></i>&nbsp; @lang('yals.company_add')
    </a>

    @if (count($companies) == 0)
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong> @lang('yals.oops') </strong>
            @lang('yals.no_companies')
        </div>

    @else
        <ul class="list-group">
        @foreach ($companies as $company)
            <li class="list-group-item index-item-row">
                <div class="row">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                        {{ link_to_companies($company['id'], 'show', $company['name']) }}
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right action-items-row">
                        <a href="{{ to_companies($company['id']) }}" data-method='DELETE' data-confirm='Are you sure?'><i class='fa fa-times'></i></a>
                        &nbsp;
                        {{ link_to_companies($company['id'], 'edit', "<i class='fa fa-edit'></i>") }}
                        &nbsp;
                        {{ link_to_companies($company['id'], 'show', "<i class='fa fa-eye'></i>") }}
                    </div>
                </div>
            </li>
        @endforeach
        </ul>
    @endif

@stop
