<?php

/**
 * General Error handler, but fall back on a pretty page when production mode is enabled
 */
App::error(function(Exception $exception, $code)
{
    if ( ! Config::get('app.debug'))
        return View::make('errors.general');
    Log::error($exception);
});

/**
 * UserException handler are thrown when an unexpected even happen related to a user (i.e: save() after validation passes)
 */
App::error(function(Yals\Repositories\UserRepositories\UserException $e) {
    return Redirect::to('/users')->withMessage($e->getMessage())->withType('danger');
});
