<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'follower_profile_id',
        'following_profile_id',
    ];

    public function follower()
    {
        return $this->belongsTo(Profile::class, 'follower_profile_id');
    }

    public function following()
    {
        return $this->belongsTo(Profile::class, 'following_profile_id');
    }

    public static function createFollow(Profile $follower, Profile $following): self
    {
        if ($follower->id === $following->id) {
            throw new \InvalidArgumentException('A profile cannot follow itself.');
        }

        return static::firstOrCreate([
            'follower_profile_id'  => $follower->id,
            'following_profile_id' => $following->id,
        ]);
    }

    public static function removeFollow(Profile $follower, Profile $following): bool
    {
        if ($follower->id === $following->id) {
            throw new \InvalidArgumentException('A profile cannot unfollow itself.');
        }

        $deleted = static::where('follower_profile_id', $follower->id)
            ->where('following_profile_id', $following->id)
            ->delete();

        return $deleted > 0;
    }
}
