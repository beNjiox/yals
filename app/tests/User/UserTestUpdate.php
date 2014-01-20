<?php

use Goutte as Goutte;

class UserTestUpdate extends TestCase
{
    public function test_view_user()
    {
        $this->_addUser(['username' => 'beNjiox', 'email' => 'me@bguez.io']);

        $crawler  = $this->client->request('GET', '/users/1');

        assertThat($crawler->filter('.panel-title')->text(), is("beNjiox"));
    }

    public function test_view_user_edit()
    {
        $user_data = ['username' => 'beNjiox', 'email' => 'me@bguez.io'];
        $this->_addUser($user_data);

        $crawler  = $this->client->request('GET', '/users/1/edit');

        $this->assertCount(1, $crawler->filter("input[name='email']"));
        $this->assertCount(1, $crawler->filter("input[name='username']"));
        $form = $crawler->selectButton('Edit this user')->form();
        assertThat($form->getValues()['username'], is('beNjiox'));
        assertThat($form->getValues()['email'], is('me@bguez.io'));
    }

    public function test_update_session_and_redirect_when_success()
    {
        $user_data = ['username' => 'beNjiox', 'email' => 'me@bguez.io'];
        $this->_addUser($user_data);

        $user_data['email'] = 'me2@bguez.io';
        $userRepo = $this->_mockUser();
        $userRepo->shouldReceive('edit')->with(1, $user_data)->once();

        $mockUserValidator = $this->_mockUserValidator();
        $mockUserValidator
            ->shouldReceive('validates')->once()->andReturn(true);

        $crawler  = $this->client->request('PATCH', '/users/1', $user_data);

        $this->assertRedirectedTo('/users/1');
        $this->assertSessionHas(['type' => 'success']);
    }

    public function test_update_session_and_redirect_when_failure()
    {
        $user_data = ['username' => 'beNjiox', 'email' => 'me@bguez.io'];
        $this->_addUser($user_data);

        $user_data['email'] = 'me2';
        $userRepo = $this->_mockUser();
        $userRepo->shouldReceive('edit')->never();

        $mockUserValidator = $this->_mockUserValidator();
        $mockUserValidator
            ->shouldReceive('validates')->once()->andReturn(false)
            ->shouldReceive('errors')->once();

        $crawler  = $this->client->request('PATCH', '/users/1', $user_data);

        $this->assertRedirectedTo('/users/1/edit');
        $this->assertSessionHas(['errors']);
    }

    public function test_update_repo_success()
    {
        $user_data  = ['username' => 'beNjiox', 'email' => 'me@bguez.io'];
        $this->_addUser($user_data);
        $userDbRepo = new Yals\Repositories\UserRepositories\DbUserRepository;

        $user_data['email'] = 'me2@bguez.io';
        $crawler = $this->client->request('PATCH', '/users/1', $user_data);
        $updated = $userDbRepo->get(1);

        assertThat(array_keys($updated), arrayContainingInAnyOrder(['id','email','username','created_at','updated_at']));
        assertThat($updated['email'], is('me2@bguez.io'));
    }

    /**
     * @expectedException Yals\Repositories\UserRepositories\UserException
     */
    public function test_repo_update_fail_because_save_fail()
    {
        $user_data  = ['username' => 'beNjiox', 'email' => 'me@bguez.io'];
        $this->_addUser($user_data);
        $user_data['username'] .= '2';
        $user_data['email'] .= '2';

        User::saving(function(){
            return false;
        });

        $userDbRepo = new Yals\Repositories\UserRepositories\DbUserRepository;
        $ret = $userDbRepo->edit(1, $user_data);
    }

}