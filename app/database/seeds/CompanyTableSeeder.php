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
            $this->company->create([
                'name'        => $faker->company,
                'email'       => $faker->safeEmail,
                'catchphrase' => $faker->catchPhrase,
                'description' => $faker->bs,
                'website_url' => $faker->url,
                'logo_path'   => $faker->imageUrl
            ]);
        }
    }
}