<div class="panel panel-warning">
      <div class="panel-heading">
            <div class="row">
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <h5>
                        Total : <strong> <a href="/comments"> {{ $nb_comments }} {{ Str::plural("Comment", $nb_comments) }} </a> </strong>
                    </h5>
                </div>
            </div>
      </div>
      <div class="panel-body">

            <div class="row">
                @foreach ($comment_stat as $type)
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <div class='well'>
                            <h3 class='text-center'> <strong>{{ $type['type'] }}</strong></h3>
                            <hr>
                            <p class='text-center'>
                                {{ $type['nb_comments'] }} {{ Str::plural('Comment', $type['nb_comments']) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            @foreach ($comments as $comment)
                <div style='margin-top:5px;padding:10px;' class='alert-{{$comment["type"]}}'>
                    <p> <strong> By: </strong> {{{ $comment['user']['username'] }}} </p>
                    <p> <b> {{{ $comment["text"] }}} </b> </p>
                    @if ($comment['created_at'] == $comment['updated_at'])
                        <small> Created at: {{ $comment['created_at'] }} </small>
                    @else
                        <small> Updated at: {{ $comment['created_at'] }} </small>
                    @endif
                </div>
            @endforeach
      </div>
</div>
