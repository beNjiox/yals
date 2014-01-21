<?php namespace Yals\Repositories\CompanyRepositories;

use Company;

class CompanyException extends \Exception {}

class DbCompanyRepository implements CompanyRepositoryInterface
{
    public function getAll()
    {
        return Company::all()->toArray();
    }

    public function add(array $data)
    {
        $company = new Company;
        if ($company->fill($data)->save()) return $company->toArray();
        throw new CompanyException("This company can't be added.");
    }

    public function get($id)
    {
        return Company::findOrFail($id)->toArray();
    }

    public function edit($id, array $data)
    {
        $company = Company::findOrFail($id)->fill($data);
        if ($company->save()) return $company->toArray();
        throw new CompanyException("This company can't be edited.");
    }

    public function deleteById($id)
    {
        if (Company::findOrFail($id)->delete()) return true;
        throw new CompanyException("This company can't be deleted.");
    }

}