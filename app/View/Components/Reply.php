<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class Reply extends Component
{
    public Post $post;
    public bool $showEngagement = true;
    public bool $showReplies = false;

    public function __construct(Post $post, $showEngagement = true, $showReplies = false)
    {
        $this->post = $post;
        $this->showEngagement = $showEngagement;
        $this->showReplies = $showReplies;
    }

    public function render()
    {
        return view('components.reply');
    }
}
