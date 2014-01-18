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
            <li class="list-group-item">
                <a href="/users/{{$user['id']}}">
                    #{{ $user['id'] }} :: {{ $user['username'] }}
                </a>
                - <small> {{ $user['email'] }} </small> <br/>
            </li>
        @endforeach
        </ul>
    @endif

@stop
