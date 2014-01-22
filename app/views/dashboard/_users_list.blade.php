<div class="panel panel-info">
  <div class="panel-heading">
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <h5>
                Most active users
                <small> Total: {{ isset($users['nb_users']) ? $users['nb_users'] : 0 }}</small>
            </h5>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
            <a href="/users">See all users</a>
        </div>
    </div>
</div>
<div class="panel-body">
    <div class='row'>
        @if (count($users) == 0)
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>No users!</strong> <a href="/users/create"> Add one </a>
        </div>
        @else
        @foreach ($users as $user)
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
            <div class='well'>
                <a href='/users/{{ $user["id"] }}'> {{{ $user['username'] }}} </a>
                @if (isset($user['comments']))
                    @foreach ($user['comments'] as $comment)
                        <div style='margin-top:5px;padding:10px;' class='alert-{{$comment["type"]}}'>
                            <p> <b> {{{ $comment["text"] }}} </b> </p>
                            @if ($comment['created_at'] == $comment['updated_at'])
                                <small> Created at: {{ $comment['created_at'] }} </small>
                            @else
                                <small> Updated at: {{ $comment['created_at'] }} </small>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
</div>

