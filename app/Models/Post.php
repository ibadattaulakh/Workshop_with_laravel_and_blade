<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'parent_id',
        'repost_of_id',
        'content',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function parent()
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Post::class, 'parent_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function repostOf()
    {
        // repost_of_id is the FK on the repost that points to the original Post
        return $this->belongsTo(Post::class, 'repost_of_id');
    }

    public function reposts()
    {
        // reverse relation: all posts that reference this post as their original
        return $this->hasMany(Post::class, 'repost_of_id');
    }

    public static function publish(Profile $profile, string $content): self
    {
        return static::create([
            'profile_id'   => $profile->id,
            'content'      => $content,
            'parent_id'    => null, // not a reply
            'repost_of_id' => null, // not a repost
        ]);
    }

    public static function reply(Profile $profile, Post $original, string $content)
    {
        return static::create([
            'profile_id' => $profile->id,
            'parent_id'  => $original->id,
            'content'    => $content,
        ]);
    }

    public static function repost(Profile $profile, Post $original, $content = null)
    {
        return static::create([
            'profile_id'   => $profile->id,
            'content'      => $content,          // null for plain reposts
            'parent_id'    => null,              // not a reply
            'repost_of_id' => $original->id,
        ]);
    }
}
