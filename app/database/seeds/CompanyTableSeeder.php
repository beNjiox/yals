<?php

use Yals\Repositories\CompanyRepositories\CompanyRepositoryInterface as CompanyRepositoryInterface;

class CompanyTableSeeder extends \Seeder {

    protected $company;

    public function __construct(CompanyRepositoryInterface $company)
    {
        $this->company = $company;
    }

    public function run() {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 8; $i++)
        {
            $this->company->add([
                'name'        => $faker->userName,
                'description' => $faker->safeEmail,
                'website_url' => $faker->url,
                'logo_path'   => $faker->imageUrl,
            ]);
        }
    }
}