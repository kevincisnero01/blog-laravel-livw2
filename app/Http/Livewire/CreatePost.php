<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{   
    public $open = false;
    public $title, $content;    
    protected $rules =[
        'title' => 'required',
        'content' => 'required'
    ];

    public function save()
    {   
        $this->validate();

        Post::create([
            'title' => $this->title,
            'content' => $this->content
        ]);

        $this->reset(['open','title','content']);
        $this->emitTo('show-post','render');
        $this->emit('alert',[
            'title' => 'Registro Exitoso', 
            'text' => 'El post se registro exitosamente',
            'icon' => 'success'
        ]);
    }
    public function render()
    {
        return view('livewire.create-post');
    }
}
