<?php

use Yals\Repositories\UserRepositories\UserRepositoryInterface       as UserRepositoryInterface;
use Yals\Repositories\CommentRepositories\CommentRepositoryInterface as CommentRepositoryInterface;
use Yals\Repositories\CompanyRepositories\CompanyRepositoryInterface as CompanyRepositoryInterface;


class DashboardController extends \BaseController
{
    protected $user;
    protected $comment;
    protected $company;

    public function __construct(UserRepositoryInterface $user, CommentRepositoryInterface $comment, CompanyRepositoryInterface $company)
    {

         $this->user    = $user;
         $this->comment = $comment;
         $this->company = $company;
     }

     public function main()
     {
        // get 3 users with the most comments and get 5 last comments
        // get 5 very last comments
        // get 3 companies with most users
        // get the numbers of each comment types

        return View::make('dashboard.index')
            ->withUsers($this->user->getAllWithComment(10))
            ->withComments($this->comment->getAll(10))
            ->withCompanies($this->company->getAll(3));
     }
}