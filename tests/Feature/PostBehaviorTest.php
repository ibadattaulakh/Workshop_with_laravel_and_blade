<?php

use App\Models\Profile;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('allows a profile to publish a post', function () {
    // Arrange: create a profile
    $profile = Profile::factory()->create();

    // Act: publish a post for the profile
    $post = Post::publish($profile, 'Hello world');

    // Assert: post exists and attributes are correct
    expect($post)->not->toBeNull();
    expect($post->profile_id)->toBe($profile->id);
    expect($post->content)->toBe('Hello world');
    expect($post->parent_id)->toBeNull();
    expect($post->repost_of_id)->toBeNull();
});

it('can reply to post', function () {
    $original = Post::factory()->create();
    $profile  = Profile::factory()->create();

    $reply = Post::reply($profile, $original, 'Nice post!');

    expect($reply->parent->is($original))->toBeTrue();
    expect($original->replies()->count())->toBe(1);
});

it('can have many replies', function () {
    $original = Post::factory()->create();

    // create 4 replies for the original
    Post::factory()->count(4)->reply($original)->create();

    expect($original->replies()->count())->toBe(4);
    expect($original->replies->first()->parent->is($original))->toBeTrue();
});

it('can create plain repost', function () {
    $original = Post::factory()->create();
    $profile  = Profile::factory()->create();

    $repost = Post::repost($profile, $original);

    expect($repost->repostOf->is($original))->toBeTrue();
    expect($repost->content)->toBeNull();
    expect($original->reposts()->count())->toBe(1);
});

it('can have many reposts', function () {
    $original = Post::factory()->create();

    // create 4 reposts for the original
    Post::factory()->count(4)->repost($original)->create();

    expect($original->reposts()->count())->toBe(4);
    expect($original->reposts->first()->repostOf->is($original))->toBeTrue();
});

it('can create quote repost', function () {
    $content = 'quote content';
    $original = Post::factory()->create();
    $profile  = Profile::factory()->create();

    $repost = Post::repost($profile, $original, $content);

    expect($repost->repostOf->is($original))->toBeTrue();
    expect($repost->content)->toBe($content);
    expect($original->reposts()->count())->toBe(1);
});

it('prevents duplicate reposts', function () {
    $original = Post::factory()->create();
    $profile  = Profile::factory()->create();

    $first  = Post::repost($profile, $original);
    $second = Post::repost($profile, $original);

    expect($first->is($second))->toBeTrue();
    expect($original->reposts()->where('profile_id', $profile->id)->count())->toBe(1);
});

it('can remove a repost', function () {
    $original = Post::factory()->create();
    $profile  = Profile::factory()->create();

    // create repost
    $repost = Post::repost($profile, $original);
    expect($repost)->not->toBeNull();

    // remove repost
    $removed = Post::removeRepost($profile, $original);
    expect($removed)->toBeTrue();

    expect($original->reposts()->where('profile_id', $profile->id)->count())->toBe(0);
});
