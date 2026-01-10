<?php


use Illuminate\Support\Facades\Route;

Route:: get ('/', function (){
    return view ('welcome');
});

Route::get('/feed', function () {
    $feedItems = [
        [
            'profile' => [
                'display_name' => 'Michael',
                'handle'       => 'mmich_jj',
                'avatar'       => '/images/michael.png',
            ],
            'posted_ago'  => '3h',
            'content'     => '<p>I made this! <a href="#">#myartwork</a> <a href="#">#pixl</a></p><img src="/images/simon-chilling.png" alt="" />',
            'like_count'  => 23,
            'reply_count' => 23,
            'repost_count' => 23,
            'replies' => [
                [
                    'profile' => [
                        'display_name' => 'Simon',
                        'handle'       => 'simonswiss',
                        'avatar'       => '/images/simon-chilling.png',
                    ],
                    'posted_ago'  => '1h',
                    'content'     => '<p>Heh — this looks just like me!</p>',
                    'like_count'  => 5,
                    'reply_count' => 2,
                    'repost_count' => 1,
                ],
            ],
        ],
        [
            'profile' => [
                'display_name' => 'Alessia',
                'handle'       => 'alessia_draws',
                'avatar'       => '/images/alessia.png',
            ],
            'posted_ago'  => '5h',
            'content'     => '<p>Working on a new piece! <a href="#">#art</a> <a href="#">#digitalart</a></p>',
            'like_count'  => 45,
            'reply_count' => 12,
            'repost_count' => 8,
            'replies' => [],
        ],
        [
            'profile' => [
                'display_name' => 'Anne',
                'handle'       => 'just_anne',
                'avatar'       => '/images/anne.png',
            ],
            'posted_ago'  => '1d',
            'content'     => '<p>Beautiful sunset today! <a href="#">#photography</a></p>',
            'like_count'  => 67,
            'reply_count' => 15,
            'repost_count' => 22,
            'replies' => [],
        ],
    ];

    // Convert to objects so we can use $item->profile->avatar in views
    $feedItems = json_decode(json_encode($feedItems));

    return view('feed', compact('feedItems'));
});

Route::get('/profile', function () {
    $feedItems = [
        [
            'profile' => [
                'display_name' => 'Michael',
                'handle'       => 'mmich_jj',
                'avatar'       => '/images/michael.png',
            ],
            'posted_ago'  => '3h',
            'content'     => '<p>I made this! <a href="#">#myartwork</a> <a href="#">#pixl</a></p><img src="/images/simon-chilling.png" alt="" />',
            'like_count'  => 23,
            'reply_count' => 23,
            'repost_count' => 23,
            'replies' => [
                [
                    'profile' => [
                        'display_name' => 'Simon',
                        'handle'       => 'simonswiss',
                        'avatar'       => '/images/simon-chilling.png',
                    ],
                    'posted_ago'  => '1h',
                    'content'     => '<p>Heh — this looks just like me!</p>',
                    'like_count'  => 5,
                    'reply_count' => 2,
                    'repost_count' => 1,
                ],
            ],
        ],
        [
            'profile' => [
                'display_name' => 'Michael',
                'handle'       => 'mmich_jj',
                'avatar'       => '/images/michael.png',
            ],
            'posted_ago'  => '1d',
            'content'     => '<p>Another great day creating! <a href="#">#creativity</a></p>',
            'like_count'  => 34,
            'reply_count' => 8,
            'repost_count' => 15,
            'replies' => [],
        ],
    ];

    // Convert to objects so we can use $item->profile->avatar in views
    $feedItems = json_decode(json_encode($feedItems));

    return view('profile', compact('feedItems'));
});