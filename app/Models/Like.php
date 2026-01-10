<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'profile_id',
        'post_id',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // convenience methods such as createLike/removeLike can be added later

    public static function createLike(Profile $profile, Post $post): Like
    {
        return static::firstOrCreate(
            ['profile_id' => $profile->id, 'post_id' => $post->id]
        );
    }

    public static function removeLike(Profile $profile, Post $post): bool
    {
        return static::where('profile_id', $profile->id)
                 ->where('post_id', $post->id)
                 ->delete() > 0;
    }
}
