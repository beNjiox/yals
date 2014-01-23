<?php

// Route::get('/users', 'UserController@indexGlobal')
Route::get('/users',        array('as'     => 'users.index', 'uses'     => 'UserController@index_global'));
Route::get('/companies',    array('as'     => 'companies.index', 'uses' => 'CompanyController@index_global'));
Route::get('/comments',     array('as'     => 'comments.index', 'uses'  => 'CommentController@index_global'));

// Route::get('/comments', 'CommentController@index_global');
// Route::get('/companies', 'CompanyController@index_global');

Route::resource('companies', 'CompanyController');
Route::resource('companies.users', 'UserController');
Route::resource('companies.users.comments', 'CommentController');

Route::get('/', 'DashboardController@main');