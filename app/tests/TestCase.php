<?php

require 'vendor/hamcrest/hamcrest-php/hamcrest/Hamcrest.php';

class TestCase extends Illuminate\Foundation\Testing\TestCase {

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
