<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory()->count(25)->create();
        $categories = Category::factory()->count(8)->create();
        $tags = Tag::factory()->count(20)->create();

        $posts = Post::factory()
            ->count(800)
            ->recycle($users)
            ->recycle($categories)
            ->create();

        $posts->each(function (Post $post) use ($tags): void {
            $post->tags()->attach($tags->random(random_int(1, 4))->pluck('id'));
        });

        $posts->take(200)->each(function (Post $post) use ($users): void {
            Comment::factory()
                ->count(10)
                ->recycle($users)
                ->for($post)
                ->create();
        });
    }
}
