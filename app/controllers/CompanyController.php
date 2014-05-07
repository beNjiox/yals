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

	public function index()
	{
		return View::make('companies.index')->withCompanies($this->company->getAll());
	}

	public function create()
	{
		return View::make('companies.create');
	}

	public function store()
	{
		if ( ! $this->validator->validates(Input::all()) )
		{
			return Redirect::to('/companies/create')->withInput()->withErrors($this->validator->errors());
		}
		$company = $this->company->create(Input::all());
		return Redirect::to('/companies')
			->with(['message' => 'The company has been successfully added.', 'type' => 'success' ]);
	}

	public function show($id)
	{
		return View::make('companies.show')->withCompany($this->company->getWith($id, ['users']));
	}

	public function edit($id)
	{
		return View::make('companies.edit')->withCompany($this->company->get($id));
	}

	public function update($id)
	{
		$inputs = Input::all();
		if ( ! $this->validator->validates($inputs, $id) )
		{
			return Redirect::to("/companies/$id/edit")->withInput()->withErrors($this->validator->errors());
		}
		$this->company->update($id, $inputs);
		return Redirect::to("/companies/$id")
			->with(['message' => "The company #{$id} has been successfully edited.", 'type' => 'success' ]);
	}

	public function destroy($id)
	{
		$this->company->deleteById($id);
		return Redirect::to("/companies")->withMessage("Company #$id has been deleted.")->withType('info');
	}

}