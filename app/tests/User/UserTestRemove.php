<?php

class UserTestRemove extends TestCase
{
    public function test_logic_remove_user_success()
    {
        $user_data  = ['username' => 'beNjiox', 'email' => 'me@bguez.io'];
        $this->_addUser($user_data);

        $mockUserRepo = $this->_mockUser();
        $mockUserRepo->shouldReceive('deleteById')->with(1)->once()->andReturn(true);
        $crawler = $this->client->request('DELETE', '/users/1');

        $this->assertRedirectedTo('/users');
        $this->assertSessionHas(['type' => 'info', 'message']);
    }

    public function test_logic_remove_user_fail()
    {
        $user_data  = ['username' => 'beNjiox', 'email' => 'me@bguez.io'];
        $this->_addUser($user_data);

        $mockUserRepo = $this->_mockUser();
        $mockUserRepo->shouldReceive('deleteById')->with(10)->once()->andReturn(false);
        $crawler = $this->client->request('DELETE', '/users/10');

        $this->assertRedirectedTo('/users');
        $this->assertSessionHas(['type' => 'danger', 'message']);
    }

    public function test_repo_remove_success()
    {
        $this->_seedWithUsers(10);
        $userDbRepo = new Yals\Repositories\UserRepositories\DbUserRepository;

        $userDbRepo->deleteById(1);
        $userDbRepo->deleteById(9);
        $users = $userDbRepo->getAll();

        assertThat($users, is(arrayWithSize(8)));
    }

    /**
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function test_repo_remove_fail_because_id_doesnt_exist()
    {
        $this->_seedWithUsers(10);
        $userDbRepo = new Yals\Repositories\UserRepositories\DbUserRepository;

        $userDbRepo->deleteById(15);
    }

    /**
     * @expectedException Yals\Repositories\UserRepositories\UserException
     */
    public function test_repo_remove_fail_because_remove_fail()
    {
        $this->_seedWithUsers(10);
        $userDbRepo = new Yals\Repositories\UserRepositories\DbUserRepository;

        User::deleting(function(){
            return false;
        });

        $userDbRepo->deleteById(1);
    }

}