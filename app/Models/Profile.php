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
        return $this->belongsToMany(
            Profile::class,
            'follows',
            'following_profile_id',  // this profile is being followed
            'follower_profile_id'    // the followers
        );
    }

    public function following()
    {
        return $this->belongsToMany(
            Profile::class,
            'follows',
            'follower_profile_id',   // this profile follows others
            'following_profile_id'   // the profiles it follows
        );
    }
}
