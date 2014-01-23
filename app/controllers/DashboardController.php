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
        return View::make('dashboard.index')
            ->withUsers($this->user->getTopByComments(3))
            ->withComments($this->comment->getAll(10, 'desc', true))
            ->withCompanies($this->company->getBiggestCompanies())
            ->withNbUsers($this->user->total())
            ->withNbCompanies($this->company->total())
            ->withNbComments($this->comment->total())
            ->withCommentStat($this->comment->statTypes());
     }
}