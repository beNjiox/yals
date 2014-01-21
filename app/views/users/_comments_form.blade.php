{{ Form::open([
      'method' => 'POST',
      'class'  => 'form-horizontal',
      'role'   => 'form',
      'route'  => [ "users.comments.store", $user['id'] ]
    ])
}}

<div class="panel panel-default show-user">
      <div class="panel-heading">
        <div class="row">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                <h3 class="panel-title">Comments</h3>
            </div>
        </div>
      </div>
      <div class="panel-body">


        @if (Session::get('comment_errors'))
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>OOps</strong> Something went wrong with your comment...
            <ul>
              @foreach (Session::get('comment_errors')->all('<li>:message</li>') as $error)
                {{ $error }}
              @endforeach
            </ul>
          </div>
        @endif

        <div class="form-group">
            {{ Form::label("type", 'Type', [ 'class' => 'control-label col-sm-2']) }}
            <div class='col-sm-10'>
                {{ Form::select("type", Config::get('app.comment_types'), null, [ 'style' => 'width:50%;' ]) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label("text", 'Comment', [ 'class' => 'control-label col-sm-2']) }}
            <div class='col-sm-10'>
                {{ Form::text("text", null, [ 'style' => 'width:50%', 'placeholder' => 'My comment ...' ]) }}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::submit('Add a new comment', [ 'class' => 'btn btn-success' ]) }}
            </div>
        </div>
      </div>
</div>

{{ Form::close() }}
