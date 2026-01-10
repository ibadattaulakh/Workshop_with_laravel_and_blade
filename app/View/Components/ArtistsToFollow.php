<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ArtistsToFollow extends Component
{
    public array $artists;

    public function __construct()
    {
        // temporary static data — replace with DB query later
        $this->artists = [
            ['name' => 'Alicia Draws', 'handle' => 'alicia', 'image' => 'images/alessia.png'],
            ['name' => 'Ann', 'handle' => 'ann', 'image' => 'images/anne.png'],
            ['name' => 'Mr Anderson', 'handle' => 'anderson', 'image' => 'images/mr-anderson.png'],
            ['name' => 'Michael', 'handle' => 'michael', 'image' => 'images/michael.png'],
        ];
    }

    public function render()
    {
        // pass data to the view
        return view('components.artists-to-follow', ['artists' => $this->artists]);
    }
}

