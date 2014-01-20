@extends ('layouts.main')

@section ('content')

    <div class="panel panel-danger">
          <div class="panel-heading">
                <h3 class="panel-title">Hum... That's not good</h3>
          </div>
          <div class="panel-body text-center">
                <h4>Sorry, something wrong just happened!</h4>
                <p>Click <a href='{{ URL::previous() }}'>here</a> to go back to the previous page.</p>
          </div>
    </div>

@stop