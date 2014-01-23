<?php namespace Yals\Repositories\UserRepositories;

interface UserRepositoryInterface {
    /**
     * This method give the $nb_users users with the most comments ($nb_comments should be retrieved)
     * @param  integer $nb_users
     * @param  integer $nb_comments
     * @return array               users with comments
     */
    public function getTopByComments($nb_users = 3, $nb_comments = 3);
    public function getAllWithComment($limit = 10);
    public function getAllFromCompanyWithComment($company_id, $limit = 10);
    public function get($id);
    public function getWith($id, array $associated_models);
    public function add(array $data);
    public function edit($id, array $data);
    public function deleteById($id);
    public function total();
}