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
	public function store($company_id)
	{
		$inputs = Input::all();
		if ( ! $this->validator->validates(Input::all()) )
		{
			return Redirect::route('companies.users.create', $company_id)->withInput()->withErrors($this->validator->errors());
		}
		$inputs['company_id'] = $company_id;
		$user = $this->user->add($inputs);
		return Redirect::route('companies.users.show', [ $company_id, $user['id'] ])
			->with(['message' => 'The user has been successfully added.', 'type' => 'success' ]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($company_id, $user_id)
	{
		$user = $this->user->getWith($user_id, [ 'comments', 'company' ]);
		if ($user['company_id'] == $company_id)
			return View::make('users.show')->withUser($user);
		throw new Illuminate\Database\Eloquent\ModelNotFoundException;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($company_id, $user_id)
	{
		$companyRepo = App::make('Yals\Repositories\CompanyRepositories\CompanyRepositoryInterface');
		$user        = $this->user->get($user_id);
		if ($user['company_id'] == $company_id)
		{
			return View::make('users.edit')->withUser($user)->withCompanies($companyRepo->getList());
		}
		throw new Illuminate\Database\Eloquent\ModelNotFoundException;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($company_id, $user_id)
	{
		$inputs = Input::all();
		if ( ! $this->validator->validates($inputs, $user_id) )
		{
			return Redirect::route("companies.users.update", [$company_id, $user_id])->withInput()->withErrors($this->validator->errors());
		}
		$this->user->edit($user_id, $inputs);
		$company_id = $inputs['company_id'];
		return Redirect::route("companies.users.show", [$company_id, $user_id])
			->with(['message' => "The user #{$user_id} has been successfully edited.", 'type' => 'success' ]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($company_id, $user_id)
	{
		if ($this->user->deleteById($user_id) !== false)
			return Redirect::route("companies.users.show", [$company_id, $user_id])->withMessage("User #$user_id has been deleted.")->withType('info');
		return $this->unexpectedError('An error occured while deleting this user.', '/users');
	}

}