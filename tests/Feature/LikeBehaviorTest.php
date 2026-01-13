<?php

use App\Models\Like;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('allows a profile to like a post', function () {
    $post = Post::factory()->create();
    $profile = Profile::factory()->create();

    $like = Like::createLike($profile, $post);

    expect($like->id)->toBeInt();
    expect($like->profile_id)->toBe($profile->id);
    expect($like->post_id)->toBe($post->id);
    expect($profile->likes()->count())->toBe(1);
    expect($post->likes()->count())->toBe(1);
});

it('prevents duplicate likes', function () {
    $post = Post::factory()->create();
    $profile = Profile::factory()->create();

    $first  = Like::createLike($profile, $post);
    $second = Like::createLike($profile, $post);

    expect($first->is($second))->toBeTrue();
    expect($post->likes()->where('profile_id', $profile->id)->count())->toBe(1);
});

it('can remove a like', function () {
    $post = Post::factory()->create();
    $profile = Profile::factory()->create();

    $like = Like::createLike($profile, $post);

    $removed = Like::removeLike($profile, $post);

    expect($removed)->toBeTrue();
    expect($post->likes()->where('profile_id', $profile->id)->count())->toBe(0);
});
