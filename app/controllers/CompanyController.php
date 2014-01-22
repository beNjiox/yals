<?php

use Yals\Repositories\CompanyRepositories\CompanyRepositoryInterface as CompanyRepositoryInterface;
use Yals\Services\Validation\CompanyValidator as Validator;

class CompanyController extends \BaseController {

	protected $company;
	protected $validator;

	public function __construct(CompanyRepositoryInterface $company, Validator $validator)
	{
		$this->company   = $company;
		$this->validator = $validator;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('companies.index')->withCompanies($this->company->getAll());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('companies.create');
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
			return Redirect::to('/companies/create')->withInput()->withErrors($this->validator->errors());
		}
		$company = $this->company->add(Input::all());
		return Redirect::to('/companies')
			->with(['message' => 'The company has been successfully added.', 'type' => 'success' ]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('companies.show')->withCompany($this->company->getWith($id, ['users']));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('companies.edit')->withCompany($this->company->get($id));
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
			return Redirect::to("/companies/$id/edit")->withInput()->withErrors($this->validator->errors());
		}
		$this->company->edit($id, $inputs);
		return Redirect::to("/companies/$id")
			->with(['message' => "The company #{$id} has been successfully edited.", 'type' => 'success' ]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if ($this->company->deleteById($id) !== false)
			return Redirect::to("/companies")->withMessage("Company #$id has been deleted.")->withType('info');
		return $this->unexpectedError('An error occured while deleting this company.', '/companies');
	}

}