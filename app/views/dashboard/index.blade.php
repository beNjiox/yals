@extends ('layouts.main')

@section ('content')

@section('breadcrumbs', Breadcrumbs::render('home'))

<div class="well">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <h2>This app is useless... but it leverages:</h2>
                <ul>
                    <li>Nested controllers</li>
                    <li>Testing integration, acceptance, unit, (100% coverage is the goal to reach)</li>
                    <li>Testable code (Repositories,services,IoC usage everywhere)</li>
                    <li> S.O.L.I.D principles </li>
                    <li>custom Vagrant build</li>
                    <li>Faker</li>
                    <li>Plural strings (ok this one is lame)</li>
                    <li>"Complex" queries</li>
                    <li>Caching (soon)</li>
                    <li>and <a href="/about"> more </a> ... !</li>
                </ul>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <h2> So basically... : </h2>
                <ul>
                    <li>
                        This app has {{ link_to_route('companies.index', 'Companies') }} =>
                        {{ link_to_route('users.index', 'Users') }} =>
                        {{ link_to_route('comments.index', 'Comments') }}
                    </li>
                    <li>A comment has a type assigned ( <i class='text-danger'>Danger</i>, <i class='text-info'>info</i> or <i class='text-warning'>warning</i> )</li>
                    <li>Easy to install:</li>
                    <ul>
                        <li>$> git clone http://www.github.com/beNjiox/yals</li>
                        <li>$> cd yals && composer install && php artisan migrate --seed</li>
                        <li>$> vagrant up</li>
                        <li>then browse http://yals.local</li>
                    </ul>
                    <li>Checkout the {{ link_to_asset('assets/images/yals_routes.png', 'routes screenshot', [ 'target' => '_blank']) }}</li>
                    <li>Checkout the <a href="#">code coverage</a></li>
                    <li>Checkout the <a href="#">code on GitHub</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

    <h2> Most active users </h2>

    @include('dashboard/_users_list')

    <h2> Biggest companies </h2>

    @include('dashboard/_companies_list')

    <h2> Latest Comments </h2>

    @include('dashboard/_comments_list')

@stop