<?php namespace Yals\Repositories\UserRepositories;

use User;

class UserException extends \Exception {}

class DbUserRepository implements UserRepositoryInterface {

    public function getAll()
    {
        return User::all()->toArray();
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
}
