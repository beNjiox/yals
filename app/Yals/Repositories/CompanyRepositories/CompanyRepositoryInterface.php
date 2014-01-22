<?php namespace Yals\Repositories\CompanyRepositories;

interface CompanyRepositoryInterface
{
    public function getAll($limit = 10);
    public function getList();
    public function get($id);
    public function getWith($id, array $associated_models);

    public function add(array $data);

    public function edit($id, array $data);

    public function deleteById($id);
}