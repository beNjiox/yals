<?php namespace Yals\Repositories\UserRepositories;

use User;

class DbUserRepository implements UserRepositoryInterface {

    public function getAll()
    {
        return User::all()->toArray();
    }

    public function add(array $data)
    {
        $user = new User;
        $user->fill($data);
        if ($user->save())
            return $user->toArray();
        return null;
    }

    public function get($id)
    {
        return User::findOrFail($id)->toArray();
    }

    public function edit($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->fill($data);
        if ($user->save())
        {
            return $user->toArray();
        }
        return null;
    }

    public function deleteById($id)
    {
        return User::findOrFail($id)->delete();
    }
}
