<?php namespace Yals\Repositories\CompanyRepositories;

interface CompanyRepositoryInterface
{
    public function getAll($limit = 10);
    // public function getAllWith($nb_companies = 3, array $associated_models = array());
    public function getList();
    public function get($id);
    public function getWith($id, array $associated_models);

    /**
     * get companies with the most users
     * @param  integer $nb_companies
     * @param integer  $nb_users per companies
     * @return array
     */
    public function getBiggestCompanies($nb_companies = 3, $nb_users = 5);

    /**
     * get the companies with the most comments
     * @param  integer $limit
     * @return array
     */
    public function getMostActiveCompanies($limit = 3);

    public function create(array $data);

    public function update($id, array $data);

    public function deleteById($id);

    public function total();
}