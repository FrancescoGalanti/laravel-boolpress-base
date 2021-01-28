<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\infoPost;
use Faker\Generator as Faker;

class InfoPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $posts = Post::all();

        foreach($posts as $post){
          $newInfo = new infoPost();

          $newInfo->post_id = $post->id;
          $newInfo->post_status = $faker->randomElement(['public','private', 'draft']);
          $newInfo->comment_status = $faker->randomElement(['open','closed', 'private']);
          $newInfo->save();
        }
    }
}
