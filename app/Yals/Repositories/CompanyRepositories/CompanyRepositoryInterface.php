<?php namespace Yals\Repositories\CompanyRepositories;

interface CompanyRepositoryInterface
{
    public function getAll();
    public function get($id);
    public function add(array $data);
    public function edit($id, array $data);
    public function deleteById($id);
}