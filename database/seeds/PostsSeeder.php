<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Post;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index)
        {
            Post::create([
                'title'         =>  $faker->sentence(),
                'content'       =>  $faker->paragraph(),
                'user_id'       =>  1,
                'created_at'    =>  now()
            ]);
        }
    }
}
