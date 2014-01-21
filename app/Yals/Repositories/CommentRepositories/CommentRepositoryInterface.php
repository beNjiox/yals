<?php namespace Yals\Repositories\CommentRepositories;

interface CommentRepositoryInterface
{
    public function add($user_id, array $data);
    public function get($comment_id);
    public function edit($comment_id, array $data);
    public function deleteById($comment_id);
}