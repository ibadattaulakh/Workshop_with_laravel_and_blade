<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'display_name',
        'handle',
        'bio',
        'avatar_url',
        'cover_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function topLevelPosts()
    {
        // Only posts that are not replies (parent_id is null)
        return $this->hasMany(Post::class)->whereNull('parent_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function followers()
    {
        return $this->belongsToMany(Profile::class, 'follows', 'following_profile_id', 'follower_profile_id');
    }

    public function followings()
    {
        return $this->belongsToMany(Profile::class, 'follows', 'follower_profile_id', 'following_profile_id');
    }

    // Helper methods for easier usage in tests and code
    public function follow(Profile $profile)
    {
        return \App\Models\Follow::createFollow($this, $profile);
    }

    public function unfollow(Profile $profile)
    {
        return \App\Models\Follow::removeFollow($this, $profile);
    }

    public function like(Post $post)
    {
        return \App\Models\Like::createLike($this, $post);
    }

    public function unlike(Post $post)
    {
        return \App\Models\Like::removeLike($this, $post);
    }

    public function repost(Post $post, ?string $content = null)
    {
        return \App\Models\Post::repost($this, $post, $content);
    }
}
