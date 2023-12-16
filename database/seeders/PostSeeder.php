<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::all()->pluck('id');

        Post::factory(10)
            ->create()
            ->each(function (Post $post) use ($tags) {
                $post->tags()->attach($tags->random(3));
            });
    }
}
