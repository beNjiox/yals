<?php

use Yals\Repositories\UserRepositories\UserRepositoryInterface as UserRepositoryInterface;

class UserTableSeeder extends \Seeder {

    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function run() {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 20; $i++)
        {
            $this->user->add([
                'username' => $faker->name,
                'email'    => $faker->email
            ]);
        }
    }
}