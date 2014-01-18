<?php namespace Yals\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app->bind(
      'Yals\Repositories\UserRepositories\UserRepositoryInterface',
      'Yals\Repositories\UserRepositories\DbUserRepository'
    );
  }

}