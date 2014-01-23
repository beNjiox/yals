
@if (Session::has('errors'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong> @lang('yals.oops') </strong>

        @lang('yals.form_errors')

        <div class='mtop'>
            @foreach ($errors->all('<li>:message</li>') as $message)
                {{ $message }}
            @endforeach
        </div>
    </div>
@endif
