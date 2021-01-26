<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   

        Post::truncate();
       /*  $data = [
            [
                "title" => "Philip",
                "body" => "Fry",
            ],
            [
                "title" => "efwfqfe",
                "body" => "fewqfwqfeqe",
            ],
        ];

        foreach($data as $item){
           $newPost = new Post();

           $newPost->title = $item['title'];
           $newPost->body = $item['body'];
           $newPost->slug =  Str::slug($item['title'], '-');

           $newPost->save();
        } */

        for($i = 0; $i < 10; $i++){
            $newPost = new Post();
            $newPost->title =  $faker->text(40);
            $newPost->body = $faker->paragraphs(1, true);
            $newPost->slug = Str::slug($newPost['title'], '-');;
            $newPost->save();
        }
        

        
    }
}
