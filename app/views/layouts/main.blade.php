<!DOCTYPE html>
<html lang="">
    <head>
        <title>@yield('title') - Yet another Laravel Sample</title>
        <meta charset=utf-8>
        <meta name=description content="">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootswatch/3.0.3/yeti/bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="/assets/css/app.css">
    </head>
    <body>

        @if (Session::has('message'))
            <div class="main-alerter alert alert-{{ Session::get('type', 'info') }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('message') }}
            </div>
        @endif

        <h1 class="text-center top_title">Yet Another Laravel Sample</h1>

        <div class="content">
            <div class="container">
                <div class="row">
                    @yield('breadcrumbs')
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Bootstrap JavaScript -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        <script src="/assets/js/app.js"></script>
    </body>
</html>