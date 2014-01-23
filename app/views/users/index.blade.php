@extends('layouts.main')

@section('content')

    @if (count($users) == 0)
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>OOps</strong> There is no users.
        </div>
    @else
        <a type="button" class="btn btn-primary btn-xs" href='/users/create'>
            <i class='fa fa-plus'></i>&nbsp;Add user
        </a>
        <ul class="list-group">
        @foreach ($users as $user)
            <li class="list-group-item user-row">
                <div class="row">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                        {{ link_to_route('companies.users.show', $user['username'], [ $user['company_id'], $user['id'] ] )}}
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right action-items-row">
                        <a href="/users/{{ $user['id'] }}" data-method='DELETE' data-confirm='Are you sure?'><i class='fa fa-times'></i></a>
                        &nbsp;
                        <a href="/users/{{ $user['id'] }}/edit"><i class='fa fa-edit'></i></a>
                        &nbsp;
                        <a href="/users/{{ $user['id'] }}"><i class='fa fa-eye'></i></a>
                    </div>
                </div>
            </li>
        @endforeach
        </ul>
    @endif

@stop
