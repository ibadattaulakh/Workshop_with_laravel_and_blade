<?php

namespace App\View\Components;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\View\Component;

class ReplyForm extends Component
{
    public Profile $profile;
    public Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
        $this->profile = auth()->user()->profile;
    }

    public function render()
    {
        return view('components.reply-form');
    }
}

