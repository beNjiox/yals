<?php namespace Yals\Repositories\UserRepositories;

use User;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

class UserException extends \Exception {}

class DbUserRepository implements UserRepositoryInterface {

    /**
     * This method give the $nb_users users with the most comments ($nb_comments should be retrieved)
     * @param  integer $nb_users
     * @param  integer $nb_comments
     * @return array               users with comments
     */
public function getTopByComments($nb_users = 3, $nb_comments = 3)
{
    $ids = $this->getIdsOfTopUsers($nb_users);
    return User::whereIn('id', $ids)->with([ 'comments' => function($query) use ($nb_comments) {
        $query->orderBy('id', 'DESC');
    } ])->get()->toArray();
}

private function getIdsOfTopUsers($nb_users)
{
    $users =
        DB::table('users')
            ->join('comments', 'users.id', '=', 'comments.user_id')
            ->select(DB::raw('count(comments.id) as nb_comments, users.username, users.id'))
            ->groupBy('users.id')
            ->orderBy(DB::raw('nb_comments'), 'desc')
            ->limit($nb_users)
            ->get();

        $ids = array_column($users, 'id');

        return $ids;
    }

    public function getAllWithComment($limit = 10)
    {
        return User::with('comments')->get()->toArray();
    }

    public function getAllFromCompanyWithComment($company_id, $limit = 10)
    {
        return User::with('comments')->where('company_id', $company_id)->get()->toArray();
    }

    public function add(array $data)
    {
        $user = new User;
        if ($user->fill($data)->save()) return $user->toArray();
        throw new UserException("This user can't added.");
    }

    public function get($id)
    {
        return User::findOrFail($id)->toArray();
    }

    public function edit($id, array $data)
    {
        $user = User::findOrFail($id)->fill($data);
        if ($user->save()) return $user->toArray();
        throw new UserException("This user can't be edited.");
    }

    public function deleteById($id)
    {
        if (User::findOrFail($id)->delete()) return true;
        throw new UserException("This user can't be deleted.");
    }

    public function getWith($id, array $associated_models)
    {
        $query = User::where('id', $id);
        foreach ($associated_models as $model)
        {
            $query = $query->with([ $model => function($query) {
                $query->orderBy('id', 'desc');
            }]);
        }
        $user = $query->first();
        if ( ! $user )
            throw new ModelNotFoundException;
        return $user;
    }

    public function total()
    {
        return User::count();
    }

}
