<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	protected function _mockUser()
	{
		$userRepo = Mockery::Mock('Yals\Repositories\UserRepositories\DbUserRepository');
		$this->app->instance('Yals\Repositories\UserRepositories\UserRepositoryInterface', $userRepo);
		return $userRepo;
	}

	protected function _mockUserValidator()
	{
		$mockUserValidator = Mockery::Mock('Yals\Services\Validation\UserValidator');
		$this->app->instance('Yals\Services\Validation\UserValidator', $mockUserValidator);
		return $mockUserValidator;
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

	protected function _addUser($data)
	{
		User::create($data);
	}

	public function setUp()
	{
		parent::setUp();
		Artisan::call('migrate:install');
		Artisan::call('migrate:refresh');
		Artisan::call('db:seed');
		Eloquent::unguard();
	}

	public function tearDown()
	{
		Mockery::close();
	}

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

}
