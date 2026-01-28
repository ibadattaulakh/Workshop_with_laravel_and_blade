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

    // Create the like if it doesn't exist; return the Like model.
    public static function createLike(Profile $profile, Post $post): self
    {
        return static::firstOrCreate(
            [
                'profile_id' => $profile->id,
                'post_id'    => $post->id,
            ],
            []
        );
    }

    // Remove a like for profile/post. Returns true if a record was deleted.
    public static function removeLike(Profile $profile, Post $post): bool
    {
        $deleted = static::where('profile_id', $profile->id)
            ->where('post_id', $post->id)
            ->delete();

        return $deleted > 0;
    }
}
