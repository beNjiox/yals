<?php

class UserTestCreate extends TestCase {

	public function testUserCreateView()
	{
		$crawler = $this->client->request('GET', '/users/create');

		$this->assertCount(1, $crawler->filter("input[name='email']"));
		$this->assertCount(1, $crawler->filter("input[name='username']"));
	}

	public function test_session_and_redirect_when_success_create_user()
	{
		$userRepo = $this->_mockUser();
		$userRepo->shouldReceive('add')->once();

		$crawler  = $this->client->request('POST', '/users', [ 'username' => 'new user', 'email' => 'new@user.com' ]);
		$this->assertRedirectedToRoute('users.index');
		$this->assertSessionHas(['message', 'type' => 'success']);
	}

	public function test_redirect_and_logic_when_failed_create_user()
	{
		$userRepo = $this->_mockUser();
		$userRepo->shouldReceive('add')->never();

		$mockUserValidator = $this->_mockUserValidator();
		$mockUserValidator
			->shouldReceive('validates')->once()->andReturn(false)
			->shouldReceive('errors')->once();

		$crawler  = $this->client->request('POST', '/users', []);

		$this->assertRedirectedToRoute('users.create');
	}

	public function test_repo_when_success_create_user()
	{
		$this->_seedWithUsers(10);

		$crawler = $this->client->request('POST', '/users', [ 'username' => 'new user', 'email' => 'new@user.com' ]);
		$userDbRepo = new Yals\Repositories\UserRepositories\DbUserRepository;
		$res        = $userDbRepo->getAll();
		$added      = $userDbRepo->get(11);

		assertThat($res, arrayWithSize(11));
		assertThat(array_keys($added), arrayContainingInAnyOrder(['id','email','username','created_at','updated_at']));
		assertThat($added['id'], is(11));
	}

	/**
	 * @expectedException Illuminate\Database\QueryException
	 */
	public function test_repo_add_fail_because_not_unique()
	{
	    $user_data  = ['username' => 'beNjiox', 'email' => 'me@bguez.io'];
	    $this->_addUser($user_data);
	    $userDbRepo = new Yals\Repositories\UserRepositories\DbUserRepository;
	    $ret = $userDbRepo->add($user_data);
	}

	/**
	 * @expectedException Yals\Repositories\UserRepositories\UserException
	 */
	public function test_repo_remove_fail_because_save_fail()
	{
	    $user_data  = ['username' => 'beNjiox', 'email' => 'me@bguez.io'];
	    User::saving(function(){
	    	return false;
	    });
	    $userDbRepo = new Yals\Repositories\UserRepositories\DbUserRepository;
	    $ret = $userDbRepo->add($user_data);
	}



}