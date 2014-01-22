@extends ('layouts.main')

@section ('content')

    <h1>Dashboard</h1>

    @include('dashboard/_users_list')

    <h2> Companies </h2>


    <h2> Comments </h2>

    @include('dashboard/_comments_list')

@stop