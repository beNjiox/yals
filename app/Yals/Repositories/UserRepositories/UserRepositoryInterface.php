<?php namespace Yals\Repositories\UserRepositories;

interface UserRepositoryInterface {
    public function getAll();
    public function get($id);
    public function getWith($id, array $associated_models);
    public function add(array $data);
    public function edit($id, array $data);
    public function deleteById($id);
}