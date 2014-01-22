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