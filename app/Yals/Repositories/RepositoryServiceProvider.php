<?php namespace Yals\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app->bind('Yals\Repositories\UserRepositories\UserRepositoryInterface', 'Yals\Repositories\UserRepositories\DbUserRepository');

    $this->app->bind('Yals\Repositories\CommentRepositories\CommentRepositoryInterface', 'Yals\Repositories\CommentRepositories\DbCommentRepository');

    $this->app->bind('Yals\Repositories\CompanyRepositories\CompanyRepositoryInterface', 'Yals\Repositories\CompanyRepositories\DbCompanyRepository');
  }

}