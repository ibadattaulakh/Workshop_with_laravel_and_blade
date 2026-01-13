<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class ReplyButton extends Component
{
    public Post $post;
    public int $count;

    public function __construct(Post $post)
    {
        $this->post = $post;
        $this->count = $post->replies_count ?? 0;
    }

    public function render()
    {
        return view('components.reply-button');
    }
}

