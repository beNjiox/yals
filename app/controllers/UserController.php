<?php

use Yals\Repositories\UserRepositories\UserRepositoryInterface as UserRepositoryInterface;
use Yals\Services\Validation\UserValidator as UserValidator;

class UserController extends \BaseController {

	protected $user;
	protected $validator;

	public function __construct(UserRepositoryInterface $user, UserValidator $validator)
	{
		$this->user      = $user;
		$this->validator = $validator;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($company_id)
	{
		return View::make('users.index')->withUsers($this->user->getAllFromCompanyWithComment($company_id));
	}

	public function index_global()
	{
		return View::make('users.index')->withUsers($this->user->getAllWithComment());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
public function create()
{
	$companyRepo = App::make('Yals\Repositories\CompanyRepositories\CompanyRepositoryInterface');

	return View::make('users.create')->withCompanies($companyRepo->getList());
}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if ( ! $this->validator->validates(Input::all()) )
		{
			return Redirect::to('/users/create')->withInput()->withErrors($this->validator->errors());
		}
		$user = $this->user->add(Input::all());
		return Redirect::to('/users')
			->with(['message' => 'The user has been successfully added.', 'type' => 'success' ]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('users.show')->withUser($this->user->getWith($id, [ 'comments', 'company' ]));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$companyRepo = App::make('Yals\Repositories\CompanyRepositories\CompanyRepositoryInterface');

		return View::make('users.edit')->withUser($this->user->get($id))->withCompanies($companyRepo->getList());
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$inputs = Input::all();
		if ( ! $this->validator->validates($inputs, $id) )
		{
			return Redirect::to("/users/$id/edit")->withInput()->withErrors($this->validator->errors());
		}
		$this->user->edit($id, $inputs);
		return Redirect::to("/users/$id")
			->with(['message' => "The user #{$id} has been successfully edited.", 'type' => 'success' ]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if ($this->user->deleteById($id) !== false)
			return Redirect::to("/users")->withMessage("User #$id has been deleted.")->withType('info');
		return $this->unexpectedError('An error occured while deleting this user.', '/users');
	}

}