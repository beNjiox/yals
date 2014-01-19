<?php

class UserTestIndex extends TestCase {

	public function testUserIndexView()
	{
		$this->_seedWithUsers(2);

		$crawler = $this->client->request('GET', '/users');

		$this->assertViewHas('users');
		$this->assertCount(2, $crawler->filter('.user-row'));
	}

	public function testUserIndexController()
	{
		$userRepo = Mockery::Mock('Yals\Repositories\UserRepositories\DbUserRepository');
		$this->app->instance('Yals\Repositories\UserRepositories\UserRepositoryInterface', $userRepo);
		$userRepo->shouldReceive('getAll')->once();

		$crawler  = $this->client->request('GET', '/users');
	}

	public function testUserIndexDb()
	{
		$this->_seedWithUsers(10);

		$repo = new Yals\Repositories\UserRepositories\DbUserRepository;
		$res = $repo->getAll();

		assertThat($res, arrayWithSize(10));
		assertThat(array_keys($res[0]), arrayContainingInAnyOrder(['id','email','username','created_at','updated_at']));
	}
}