<?php

class UserControllerTest extends TestCase {

	public function setUp()
	{
		parent::setUp();
		Artisan::call('migrate:install');
		Artisan::call('migrate:refresh');
		Eloquent::unguard();
	}

	public function tearDown()
	 {
	     Mockery::close();
	 }

	protected function _seedWithUsers($nb_users = 2)
	{
		$faker = Faker\Factory::create();

		for ($i = 0; $i < $nb_users; $i++)
		{
			User::create([
				'username' => $faker->name,
				'email'    => $faker->email
			]);
		}
	}

	public function testUserViewIndex()
	{
		// arange
		$this->_seedWithUsers(2);

		// act
		$crawler = $this->client->request('GET', '/users');

		// assert
		$this->assertViewHas('users');
		$this->assertCount(2, $crawler->filter('.user-row'));
	}

	public function testUserControllerIndex()
	{
		// arrange
		$userRepo = Mockery::Mock('Yals\Repositories\UserRepositories\DbUserRepository');
		$this->app->instance('Yals\Repositories\UserRepositories\UserRepositoryInterface', $userRepo);
		$userRepo->shouldReceive('getAll')->once();

		// act
		$crawler  = $this->client->request('GET', '/users');
	}

	public function testUserControllerIndexResult()
	{
		$this->_seedWithUsers(10);

		// arrange
		$repo = new Yals\Repositories\UserRepositories\DbUserRepository;
		$res = $repo->getAll();

		// act
		$this->assertCount(10, $res);
		// assertThat("test", is('test'));

		// assertThat(array_keys($res[0]), arrayContainingInAnyOrder(['id','email','username','created_at','updated_at']));
	}



}