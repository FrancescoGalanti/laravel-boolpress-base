<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Comment;
use Faker\Generator as Faker;

class CommentsTableSeeder extends Seeder
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
            for ($i=0; $i < 3; $i++) { 
                $newComment = new Comment();

                $newComment->post_id = $post->id;
                $newComment->author = $faker->userName();
                $newComment->text = $faker->sentence(10);

                $newComment->save();
            }
           
        }
    }
}
