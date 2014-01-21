<?php

use Yals\Repositories\CommentRepositories\CommentRepositoryInterface as CommentRepositoryInterface;

class CommentTableSeeder extends \Seeder {

    protected $comment;

    public function __construct(CommentRepositoryInterface $comment)
    {
        $this->comment = $comment;
    }

    public function run() {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 150; $i++)
        {
            $this->comment->add(mt_rand(1, 20), [
                'type'    => [ 'warning', 'danger', 'info' ][mt_rand(0,2)],
                'text'    => $faker->sentence(10)
            ]);
        }
    }
}