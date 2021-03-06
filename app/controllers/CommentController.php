<?php

use Yals\Repositories\CommentRepositories\CommentRepositoryInterface as CommentRepositoryInterface;
use Yals\Services\Validation\CommentValidator as CommentValidator;

class CommentController extends \BaseController {

	protected $comment;
	protected $validator;

	public function __construct(CommentRepositoryInterface $comment, CommentValidator $validator)
	{
		$this->comment   = $comment;
		$this->validator = $validator;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($company_id, $user_id)
	{

		if ( ! $this->validator->validates(Input::all()) )
		{
			return Redirect::route('companies.users.show', [ $company_id, $user_id ])->withInput()->withCommentErrors($this->validator->errors());
		}
		$comment = $this->comment->add($user_id, Input::all());
		return Redirect::route('companies.users.show', [ $company_id, $user_id ])
			->with(['message' => 'The comment has been successfully added.', 'type' => 'success' ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $comment_id
	 * @return Response
	 */
	public function update($company_id, $user_id, $comment_id)
	{
		$inputs = Input::all();
		if ( ! $this->validator->validates($inputs, $comment_id) )
		{
			return Redirect::route('companies.users.show', [ $company_id, $user_id ])->withInput()->withCommentErrors($this->validator->errors());
		}
		$this->comment->edit($comment_id, $inputs);
		return Redirect::route('companies.users.show', [ $company_id, $user_id ])
			->with(['message' => "The comment #{$comment_id} has been successfully edited.", 'type' => 'success' ]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $user_id
	 * @param  int  $comment_id
	 * @return Response
	 */
	public function destroy($company_id, $user_id, $comment_id)
	{
		if ($this->comment->deleteById($comment_id) !== false)
			return Redirect::route('companies.users.show', [ $company_id, $user_id ])->withCommentMessage("Comment #$comment_id has been deleted.")->withType('info');
		return $this->unexpectedError('An error occured while deleting this comment.', "/users/$user_id?t=c");
	}

}