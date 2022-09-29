<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowPost extends Component
{
    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    public function render()
    {   
        $posts = Post::where('title','like','%'.$this->search.'%')
            ->OrderBy($this->sort, $this->direction)
            ->get();

        return view('livewire.show-post',['posts' => $posts])
        ->layout('layouts.app');
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {

            if ($this->direction == 'asc') {
                $this->direction = 'desc';
            } else {
                $this->direction = 'asc';
            }
        
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
        
        
    }
}
