<?php

Route::get('/', function()
{
	return Redirect::to("/users");
});

Route::resource('users', 'UserController');
Route::resource('companies', 'CompanyController');
Route::resource('users.comments', 'CommentController');