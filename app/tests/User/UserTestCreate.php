<?php

class UserTestCreate extends TestCase {

	public function testUserCreateView()
	{
		$crawler = $this->client->request('GET', '/users/create');

		$this->assertCount(1, $crawler->filter("input[name='email']"));
		$this->assertCount(1, $crawler->filter("input[name='username']"));
	}

	public function testUserCreateSuccess()
	{
		$userRepo = Mockery::Mock('Yals\Repositories\UserRepositories\DbUserRepository');
		$this->app->instance('Yals\Repositories\UserRepositories\UserRepositoryInterface', $userRepo);
		$userRepo->shouldReceive('add')->once();

		$crawler  = $this->client->request('POST', '/users', [ 'username' => 'new user', 'email' => 'new@user.com' ]);
	}

	public function testUserIndexDb()
	{
		$this->_seedWithUsers(10);

		$crawler = $this->client->request('POST', '/users', [ 'username' => 'new user', 'email' => 'new@user.com' ]);
		$res     = User::all()->toArray();
		$added   = User::where('username', 'new user')->first()->toArray();

		assertThat($res, arrayWithSize(11));
		assertThat(array_keys($added), arrayContainingInAnyOrder(['id','email','username','created_at','updated_at']));
		assertThat($added['id'], is(11));
	}


}