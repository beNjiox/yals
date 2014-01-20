<?php

Route::get('/', function()
{
	return Redirect::to("/users");
});

Route::resource('users', 'UserController');