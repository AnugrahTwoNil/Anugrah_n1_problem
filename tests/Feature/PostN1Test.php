<?php

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('renders the post list with a query per post author', function () {
    $category = Category::factory()->create();
    $authors = User::factory()->count(4)->create();
    Post::factory()->count(4)->recycle($authors)->for($category)->create();

    $response = $this->get('/posts');

    $response->assertSee('800 post, satu relasi')
        ->assertHeader('X-Query-Count');

    expect((int) $response->headers->get('X-Query-Count'))->toBeGreaterThan(4);
});

it('renders the relationship report with repeated relationship queries', function () {
    $category = Category::factory()->create();
    $authors = User::factory()->count(2)->create();
    $posts = Post::factory()->count(2)->recycle($authors)->for($category)->create();
    $tag = Tag::factory()->create();

    $posts->each(function (Post $post) use ($tag, $authors): void {
        $post->tags()->attach($tag);
        Comment::factory()->recycle($authors)->for($post)->create();
    });

    $response = $this->get('/posts-report');

    $response->assertSee('200 post, empat relasi')
        ->assertHeader('X-Query-Count');

    expect((int) $response->headers->get('X-Query-Count'))->toBeGreaterThan(8);
});
