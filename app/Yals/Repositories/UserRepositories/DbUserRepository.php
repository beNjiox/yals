<?php namespace Yals\Repositories\UserRepositories;

use Eloquent;
use User;

class DbUserRepository extends Eloquent implements UserRepositoryInterface {

    protected $fillable = [ 'username', 'email' ];
    protected $guarded  = [ 'id' ];
    protected $table    = 'users';

    public function getAll()
    {
        return User::all()->toArray();
    }

    public function add(array $data)
    {
        $this->fill($data);
        if ($this->save())
            return $this->toArray();
        return null;
    }

    public function get($id)
    {
        return User::findOrFail($id)->toArray();
    }

    public function edit($id, array $data)
    {
        $user = $this->findOrFail($id);
        $user->fill($data);
        if ($user->save())
        {
            return $user->toArray();
        }
        return null;
    }

    public function deleteById($id)
    {
        return $this->findOrFail($id)->delete();
    }
}
