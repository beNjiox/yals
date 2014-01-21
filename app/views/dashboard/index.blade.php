@extends ('layouts.main')

@section ('content')

    <h1>Dashboard</h1>

    @include('dashboard/_users_list')

    <h2> Companies </h2>
    {{ var_dump($companies) }}

    <h2> Comments </h2>
    {{ var_dump($comments) }}

@stop