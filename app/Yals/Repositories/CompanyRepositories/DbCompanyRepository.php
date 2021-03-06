<?php namespace Yals\Repositories\CompanyRepositories;

use Company;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

class CompanyException extends \Exception {}

class DbCompanyRepository implements CompanyRepositoryInterface
{

    public function create(array $data)
    {
        $company = new Company;
        if ($company->fill($data)->save()) return $company->toArray();
        throw new CompanyException("This company can't be added.");
    }

    public function get($id)
    {
        return Company::findOrFail($id)->toArray();
    }

    public function update($id, array $data)
    {
        $company = Company::findOrFail($id)->fill($data);
        if (!$company->save())
            throw new CompanyException("This company can't be edited.");
        return $company->toArray();
    }

    public function deleteById($id)
    {
        if (Company::findOrFail($id)->delete()) return true;
        throw new CompanyException("This company can't be deleted.");
    }

    public function getAll($limit = 10)
    {
        return Company::all()->toArray();
    }

    public function getBiggestCompanies($nb_companies = 3, $nb_users = 5)
    {
        $data['companies'] =
                 DB::table('companies')
                    ->join('users', 'users.company_id', '=', 'companies.id')
                    ->select(DB::raw('count(users.company_id) as nb_users, companies.id'))
                    ->groupBy('users.company_id')
                    ->orderBy(DB::raw('nb_users'), 'desc')
                    ->limit($nb_companies)
                    ->get();

        $ids = array_column($data['companies'], 'id');

        $companies = Company::whereIn('id', $ids)->with('users')->get()->toArray();

        return array_reverse($companies);
    }

    public function getMostActiveCompanies($limit = 3) { }

    public function getList()
    {
        return Company::lists('name', 'id');
    }

    public function getWith($id, array $associated_models)
    {
        $query = Company::where('id', $id);
        foreach ($associated_models as $model)
        {
            $query = $query->with([ $model => function($query) {
                $query->orderBy('id', 'desc');
            }]);
        }
        $company = $query->first();
        if ( ! $company )
            throw new ModelNotFoundException;
        return $company;
    }


    public function total()
    {
        return Company::count();
    }

}