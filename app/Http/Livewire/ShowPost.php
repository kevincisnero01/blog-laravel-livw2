<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowPost extends Component
{
    public $search;

    public function render()
    {   
        $posts = Post::where('title','like','%'.$this->search.'%')->get();
        return view('livewire.show-post',['posts' => $posts])
        ->layout('layouts.app');
    }
}
