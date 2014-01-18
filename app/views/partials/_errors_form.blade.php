
@if (Session::has('errors'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Oops</strong> It seems that your form hasn't been perfectly filled.

        <div class='mtop'>
            @foreach ($errors->all('<li>:message</li>') as $message)
                {{ $message }}
            @endforeach
        </div>
    </div>
@endif
