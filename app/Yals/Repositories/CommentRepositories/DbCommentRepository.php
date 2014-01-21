<?php namespace Yals\Repositories\CommentRepositories;

use Comment;

class CommentException extends \Exception {}

class DbCommentRepository implements CommentRepositoryInterface {

    public function add($user_id, array $data)
    {
        $comment = new Comment;
        $data['user_id'] = $user_id;
        if ($comment->fill($data)->save()) return $comment->toArray();
        throw new CommentException("This comment can't added.");
    }

    public function get($id)
    {
        return Comment::findOrFail($id)->toArray();
    }

    public function edit($comment_id, array $data)
    {
        $comment = Comment::findOrFail($id)->fill($data);
        if ($comment->save()) return $comment->toArray();
        throw new CommentException("This comment can't be edited.");
    }

    public function deleteById($comment_id)
    {
        if (Comment::findOrFail($id)->delete()) return true;
        throw new CommentException("This comment can't be deleted.");
    }
}
